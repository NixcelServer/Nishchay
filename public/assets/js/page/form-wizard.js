'use strict';
$(function () {
    var form = $('#wizard_with_validation').show();
    form.steps({
        headerTag: 'h3',
        bodyTag: 'fieldset',
        transitionEffect: 'slideLeft',
        onInit: function (event, currentIndex) {
            // Set tab width
            var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
            var tabCount = $tab.length;
            $tab.css('width', (100 / tabCount) + '%');

            // Set button waves effect
            setButtonWavesEffect(event);
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            // Perform validation before proceeding to the next step
            if (currentIndex < newIndex) {
                form.validate().settings.ignore = ':disabled,:hidden';
                return form.valid();
            }
            return true;
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ':disabled';
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            // Submit the form when finished
            form.submit();
        }
    });

    // Function to set button waves effect
    function setButtonWavesEffect(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
    }

    // Step-specific form submission handling
    form.on('click', '[href="#next"]', function (e) {
        e.preventDefault();
        var currentStep = form.steps('getCurrentIndex');

        // Perform step-specific actions based on current step
        switch (currentStep) {
            case 0:
                // Submit basic information form
                $.post('/hr/editemp/basicinfo', form.serialize(), function (data) {
                    // Handle response if needed
                    form.steps('next');
                });
                break;
            case 1:
                // Submit previous employee details form
                $.post('/hr/editemp/storeprevempdetails', form.serialize(), function (data) {
                    // Handle response if needed
                    form.steps('next');
                });
                break;
            case 2:
                // Submit official details form
                $.post('/hr/editemp/storeofficialdetails', form.serialize(), function (data) {
                    // Handle response if needed
                    form.steps('next');
                });
                break;
            // Add cases for other steps as needed
            default:
                break;
        }       
    });
});
