(function ($) {
    var mentors;
    if ((mentors = $('.mentors')).length) {
        var $container = $('.mentors .content');
        $container.masonry({
            columnWidth: $('.mentor').innerWidth(),
            itemSelector: '.mentor'
        });
    }
}(jQuery));