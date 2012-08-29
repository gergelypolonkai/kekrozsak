/* TODO: The following two functions should also update the top-left profile
* box
*/
function favouriteOn()
{
    var elem = $(this)
    var topicSlug = elem.attr('id').replace(/^favourite-topic-button-/, '');
    classList = elem.attr('class').split(/\s+/);
    topicGroupSlug = null;
    for (i in classList) {
        if (classList[i].match(/^topicgroup-/)) {
            topicGroupSlug = classList[i].replace(/^topicgroup-/, '');
            break;
        }
    }
    if (topicGroupSlug == null) {
        return false;
    }
    url = Routing.generate('KekRozsakFrontBundle_forumFavouriteTopic', {
        topicGroupSlug: topicGroupSlug,
        topicSlug:      topicSlug
    });
    $.ajax({
        type: 'GET',
        url:  url
    }).done(function() {
        elem.find('img').attr('alt', '[Kedvenc]');
        elem.find('img').attr('src', AssetsHelper.getUrl('bundles/kekrozsakfront/images/penta-yellow-24.png'));
        elem.removeClass('favourite-topic-button');
        elem.addClass('unfavourite-topic-button');
        elem.attr('id', 'unfavourite-topic-button-' + topicSlug);
        elem.off('click.updateFav');
        elem.on('click.updateFav', favouriteOff);
    }).error(function() {
        alert('Nem siker!');
    });
}

function favouriteOff()
{
    var elem = $(this)
    var topicSlug = elem.attr('id').replace(/^unfavourite-topic-button-/, '');
    classList = elem.attr('class').split(/\s+/);
    topicGroupSlug = null;
    for (i in classList) {
        if (classList[i].match(/^topicgroup-/)) {
            topicGroupSlug = classList[i].replace(/^topicgroup-/, '');
            break;
        }
    }
    if (topicGroupSlug == null) {
        return false;
    }
    url = Routing.generate('KekRozsakFrontBundle_forumUnfavouriteTopic', {
        topicGroupSlug: topicGroupSlug,
        topicSlug:      topicSlug
    });
    $.ajax({
        type: 'GET',
        url:  url
    }).done(function() {
        elem.find('img').attr('alt', '[Nem kedvenc]');
        elem.find('img').attr('src', AssetsHelper.getUrl('/bundles/kekrozsakfront/images/penta-blue-24.png'));
        elem.removeClass('unfavourite-topic-button');
        elem.addClass('favourite-topic-button');
        elem.attr('id', 'favourite-topic-button-' + topicSlug);
        elem.off('click.updateFav');
        elem.on('click.updateFav', favouriteOn);
    }).error(function() {
        alert('Nem siker!');
    });
}

function setupFavButtons()
{
    $('.favourite-topic-button').on('click.updateFav', favouriteOn);
    $('.unfavourite-topic-button').on('click.updateFav', favouriteOff);
}

$(document).ready(setupFavButtons);
