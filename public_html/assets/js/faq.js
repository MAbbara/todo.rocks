const accordionHeader = document.querySelectorAll(".accordion-header");
const accordionContents = document.querySelectorAll(".accordion-content");

accordionHeader.forEach((header) => {
    header.addEventListener("click", function () {
        
        accordionContents.forEach((content) => {
            let childHeader = content.parentElement.querySelector(".accordion-header")
            if (childHeader != header) {
                content.style.maxHeight = `0px`;
                childHeader.querySelector(".fas").classList.add("fa-plus");
                childHeader.querySelector(".fas").classList.remove("fa-minus");
            }
        });

        const accordionContent = header.parentElement.querySelector(".accordion-content");
        let accordionMaxHeight = accordionContent.style.maxHeight;

        // Condition handling
        if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
            accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 32}px`;
            header.querySelector(".fas").classList.remove("fa-plus");
            header.querySelector(".fas").classList.add("fa-minus");
        } else {
            accordionContent.style.maxHeight = `0px`;
            header.querySelector(".fas").classList.add("fa-plus");
            header.querySelector(".fas").classList.remove("fa-minus");
        }

    });
});
