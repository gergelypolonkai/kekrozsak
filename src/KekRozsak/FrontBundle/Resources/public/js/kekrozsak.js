function doPopup(title, content, url, w, h, callback)
{
    $('#popup-title').html(title);
    $('#popup-content').html(content);
    $('#popup-container').css('width', w + 'px');
    $('#popup-container').css('height', h + 'px');
    $('#popup-inside').css('width', (w - 8) + 'px');
    $('#popup-inside').css('height', (h - 8) + 'px');
    $('#popup-scrollable').css('width', (w - 8) + 'px');
    $('#popup-scrollable .viewport').css('width', (w - 28) + 'px');
    $('#popup-scrollable .viewport').css('height', (h - 54) + 'px');
    $('#popup-container').center();
    $('#popup-container').fadeIn();
    $.ajax({
        method: 'GET',
        url:    url
    }).done(function(data)
    {
        $('#popup-content').html(data);
        $('#popup-scrollable').tinyscrollbar();
        $('.userdata').cluetip();

        if (callback != null) {
            callback();
        }
    }).error(function()
    {
        $('#popup-content').html('Nem sikerült betölteni a könyv adatait.');
    });
}

function resizeBoxes()
{
    bottomLineTop = $('#bottom-line').position().top;
    contentOutlineTop = $('#content-outline').position().top;
    contentHeight = $('#content-outline').outerHeight();
    newsHeight = $('#hirek').outerHeight();
    minHeight = bottomLineTop - contentOutlineTop;
    // TODO: Resize content to its original small size if news is hidden

    height = Math.max(contentHeight, newsHeight, minHeight);
    if ($('#content-outline').outerHeight() < height) {
        $('#content-outline').css('height', height + 'px');
    }
    if ($('#hirek').is(':visible') && ($('#hirek').outerHeight() < height)) {
        $('#hirek').css('height', height + 'px');
    }
}

jQuery.fn.center = function() {
    this.css('top', Math.max(0, (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop()) + 'px');
    this.css('left', Math.max(0, (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft()) + 'px');
    return this;
};

$(document).ready(function() {
    // Resize news and content boxes to correctly fill the page
    resizeBoxes();

    $('#popup-close').click(function() { $('#popup-container').fadeOut(); });
    $('#popup-scrollable').tinyscrollbar();

    $('#news-button').click(function()
    {
        $('#news-button').hide();
        $('#content-outline').css('width', '740px');
        $('#hirek').show();
        $('#news-list').html('Betöltés...');

        $.ajax({
            method: 'GET',
            url: Routing.generate('KekRozsakFrontBundle_newsSideList')
        }).done(function(data)
        {
            $('#news-list').html(data);
            resizeBoxes();
        }).error(function()
        {
            $('#news-list').html('Nem sikerült betölteni a híreket!');
            resizeBoxes();
        });
    });

    $('#news-close-button').click(function()
    {
        $('#news-content').html('');
        $('#hirek').hide();
        $('#content-outline').css('width', '960px');
        $('#news-button').show();
        resizeBoxes();
    });
});