$(document).ready(function() {

    // Check for click events on the navbar burger icon
    $(".navbar-burger").click(function() {

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");

    });

    $(".tab").click(function() {
        var $id = $(this).attr('id');
        $("li.tab,div.tab-page").removeClass("is-active");
        $("#" + $id + ",div.tab-page." + $id).toggleClass("is-active");
    });

    $("#bt-add-category").click(function() {
        tag = window.prompt("カテゴリー名を入力してください", "");

        if (tag != "" && tag != null) {
            $("#new-category-field").append(
                '<div class="control">' +
                '    <div class="tags has-addons">' +
                '        <a class="tag is-link">' +
                tag +
                '        </a>' +
                '        <a class="tag is-delete"></a>' +
                '        <input type="hidden" name="new-tag-name[]" value="' + tag + '">' +
                '    </div>' +
                '</div>'
            );

            $(".tag.is-delete").off("click");
            $(".tag.is-delete").click(function() {
                $(this).parents(".control").remove();
            });
        }
    });

    // var date = bulmaCalendar.attach('[type="date"]', {"type" : "date", "dateFormat" : "YYYY-MM-DD"});
    // var time = bulmaCalendar.attach('[type="time"]', {"type" : "time", "dateFormat" : "YYYY-MM-DD"});
});
