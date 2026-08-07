import "./bootstrap";

/**
 * Generic submit-button loader: any <button class="js-loading-btn"> inside a
 * submitted form gets disabled and shows a spinner, so slow actions (raising
 * an invoice, generating a PDF, sending an email) give immediate feedback.
 */
document.addEventListener("submit", function (event) {
    const button = event.target.querySelector(".js-loading-btn");
    if (!button || button.disabled) return;

    button.disabled = true;
    const loadingText = button.dataset.loadingText || "Processing...";
    button.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
        ${loadingText}
    `;
});

/**
 * Checking validity of category name immediately
 */
document.addEventListener("DOMContentLoaded", function () {
    const titleInput = document.getElementById("name");
    const titleValidationMessage = document.getElementById(
        "title-validation-message"
    );
    if (!titleInput || !titleValidationMessage) return;

    titleInput.addEventListener("input", function () {
        const title = titleInput.value.trim();

        if (title.length > 0) {
            fetch(`/check-title?name=${encodeURIComponent(title)}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.exists) {
                        titleValidationMessage.textContent =
                            "This category name is already in use.";
                        titleValidationMessage.classList.remove("hidden");
                        titleInput.setCustomValidity(
                            "This category name is already in use."
                        );
                    } else {
                        titleValidationMessage.classList.add("hidden");
                        titleInput.setCustomValidity("");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        } else {
            titleValidationMessage.classList.add("hidden");
            titleInput.setCustomValidity("");
        }
    });
});

/**
 * Invoice line-item repeater (create/edit invoice forms).
 * Purely for live UX feedback — totals are always recomputed server-side on save.
 */
document.addEventListener("DOMContentLoaded", function () {
    const itemsBody = document.getElementById("invoice-items-body");
    if (!itemsBody) return;

    const addButton = document.getElementById("invoice-add-item");
    const template = document.getElementById("invoice-item-row-template");
    const taxRateInput = document.querySelector(".invoice-tax-rate");
    const subtotalDisplay = document.getElementById("invoice-subtotal-display");
    const taxDisplay = document.getElementById("invoice-tax-display");
    const totalDisplay = document.getElementById("invoice-total-display");

    // Each row needs its own numeric items[N] index (PHP groups form fields by
    // exact key, so items[][x] on multiple fields per row scatters them across
    // different top-level indices instead of grouping them). Never reuse an
    // index, even after a row is removed, so two rows can't collide.
    let nextItemIndex = itemsBody.querySelectorAll(".invoice-item-row").length;

    function recalcRow(row) {
        const qty = parseFloat(row.querySelector(".item-quantity").value) || 0;
        const price = parseFloat(row.querySelector(".item-unit-price").value) || 0;
        const amount = qty * price;
        row.querySelector(".item-amount").textContent = amount.toFixed(2);
        return amount;
    }

    function recalcTotals() {
        let subtotal = 0;
        itemsBody.querySelectorAll(".invoice-item-row").forEach((row) => {
            subtotal += recalcRow(row);
        });

        const taxRate = taxRateInput ? parseFloat(taxRateInput.value) || 0 : 0;
        const taxAmount = subtotal * (taxRate / 100);
        const total = subtotal + taxAmount;

        if (subtotalDisplay) subtotalDisplay.textContent = subtotal.toFixed(2);
        if (taxDisplay) taxDisplay.textContent = taxAmount.toFixed(2);
        if (totalDisplay) totalDisplay.textContent = total.toFixed(2);
    }

    itemsBody.addEventListener("input", function (event) {
        if (
            event.target.classList.contains("item-quantity") ||
            event.target.classList.contains("item-unit-price")
        ) {
            recalcTotals();
        }
    });

    itemsBody.addEventListener("click", function (event) {
        if (event.target.classList.contains("invoice-remove-item")) {
            const rows = itemsBody.querySelectorAll(".invoice-item-row");
            if (rows.length > 1) {
                event.target.closest(".invoice-item-row").remove();
            } else {
                rows[0].querySelectorAll("input").forEach((input) => {
                    input.value = input.classList.contains("item-quantity") ? 1 : "";
                });
            }
            recalcTotals();
        }
    });

    if (addButton && template) {
        addButton.addEventListener("click", function () {
            const clone = template.content.cloneNode(true);
            const index = nextItemIndex++;

            clone.querySelectorAll("[name]").forEach((input) => {
                input.name = input.name.replace("__INDEX__", index);
            });

            itemsBody.appendChild(clone);
        });
    }

    if (taxRateInput) {
        taxRateInput.addEventListener("input", recalcTotals);
    }

    recalcTotals();
});
