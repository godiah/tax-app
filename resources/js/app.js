import "./bootstrap";

/**
 * Checking validity of category name immediately
 */
document.addEventListener("DOMContentLoaded", function () {
    const titleInput = document.getElementById("name");
    const titleValidationMessage = document.getElementById(
        "title-validation-message"
    );

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
