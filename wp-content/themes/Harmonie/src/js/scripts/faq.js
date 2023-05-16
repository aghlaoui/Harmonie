

$(document).ready(function () {
    "use strict";
       /*----------------------------- Faq Block Toggle -------------------------------- */
    $(document).ready(function () {
        $(".ec-faq-wrapper .ec-faq-block .ec-faq-content").addClass("ec-faq-dropdown");

        $(".ec-faq-block .ec-faq-title ").click(function () {
            var $this = $(this).closest('.ec-faq-wrapper .ec-faq-block').find('.ec-faq-dropdown');
            $this.slideToggle('slow');
            $('.ec-faq-dropdown').not($this).slideUp('slow');
        });
    }); 
});