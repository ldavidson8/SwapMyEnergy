var siteAccordion = document.getElementsByClassName("site-accordion");
var i;

for (i = 0; i < siteAccordion.length; i++)
{
    siteAccordion[i].addEventListener("click", function()
    {
        this.classList.toggle("site-accordion-active");
        var siteAccordionPanel = this.nextElementSibling;
        if (siteAccordionPanel.style.maxHeight)
        {
            siteAccordionPanel.style.maxHeight = null;
        }
        else
        {
            siteAccordionPanel.style.maxHeight = "none";
        }
    });
}