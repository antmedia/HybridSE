EmbeddedRepresentationXsl.ImageIndex = 0;

function EmbeddedRepresentationXsl() {

    this.Initialize = function (setOriginalContentElement, dynaElement) {
        $(".embeddedUrlRepresentationWrapper .embeddedUrlPicture").bestFitOrCenterize(true, true, null, setOriginalContentElement, dynaElement);
        $(".embeddedUrlRepresentationWrapper .playvideo").bestFitOrCenterize(false, true, $(".embeddedUrlRepresentationWrapper .embeddedUrlPictureWrapper"), setOriginalContentElement, dynaElement);
        EmbeddedRepresentationXsl.ImageIndex = 0;
    };
    
    this.LoadVideo = function (callerElement, html, targetId, usedWidth, usedHeight, elementsToHide) {
        $("#" + targetId).parent().show();
        var embedifyMeConfiguration = new EmbedifyMeConfiguration();
        replaceSwfWithEmptyDiv(targetId);
        if (callerElement != null) callerElement.hide('slow');
        if (elementsToHide) $(elementsToHide).hide();

        var unescapedValue = unescape(html);
        if (unescapedValue.indexOf("swfobject") == 0) {
            replaceSwfWithEmptyDiv(targetId);
            unescapedValue = unescapedValue.replace("/jwplayer/player.swf", embedifyMeConfiguration.jwPlayerSwfPath);
            eval(unescapedValue);
            return;
        }
        if (unescapedValue.indexOf("<script") != 0) {
            if (unescapedValue != "") {
                callerElement.after(unescapedValue);
            }
            return;
        }

        //parse src of script
        var scriptSourceRegex = /script(?:( *)type="([^\"]+)")?( *)src="([^\"]+)"/gi;
        unescapedValue.match(scriptSourceRegex);
        var scriptSource = RegExp.$4;


        var iframeSrc = embedifyMeConfiguration.scriptIFrameHost + "?url=" + encodeURIComponent(scriptSource);

        var iframe = document.createElement('iframe');
        iframe.src = iframeSrc;
        iframe.width = usedWidth;
        iframe.height = usedHeight;
        document.getElementById(targetId).appendChild(iframe);

    };

    this.Navigate = function (prevElement, nextElement, direction, images, imageWidths, imageHeights, disabledClassName, imageElement, navStatusElement) {
        var elementClass = direction == 1 ? $(nextElement).attr('class') : $(prevElement).attr('class');
        if (elementClass.indexOf(disabledClassName) != -1) {
            return;
        }
        var embedifyMeConfiguration = new EmbedifyMeConfiguration();

        //update imageindex
        EmbeddedRepresentationXsl.ImageIndex += direction;

        //set image
        var thumbs = images.split("*");
        var widths = imageWidths.split("*");
        var heights = imageHeights.split("*");
        $(imageElement).attr('src', embedifyMeConfiguration.blankIcon);

        $(imageElement).attr("src", thumbs[EmbeddedRepresentationXsl.ImageIndex]);
        $(imageElement).css({ 'width': '', 'height': '' });

        //update nav status
        navStatusElement.html((EmbeddedRepresentationXsl.ImageIndex + 1) + "/" + (thumbs.length - 1));

        if (widths[EmbeddedRepresentationXsl.ImageIndex] > 0) {
            $(imageElement).width(widths[EmbeddedRepresentationXsl.ImageIndex] + "px");
        }
        if (heights[EmbeddedRepresentationXsl.ImageIndex] > 0) {

            $(imageElement).height(heights[EmbeddedRepresentationXsl.ImageIndex] + "px");
        }

        //change class names of elements according to the index
        prevElement.attr('class', prevElement.attr('class').replace(disabledClassName, ""));
        nextElement.attr('class', nextElement.attr('class').replace(disabledClassName, ""));
        if (EmbeddedRepresentationXsl.ImageIndex == 0) {
            prevElement.attr('class', prevElement.attr('class') + '' + disabledClassName);
        }
        if (EmbeddedRepresentationXsl.ImageIndex == thumbs.length - 2) {
            nextElement.attr('class', nextElement.attr('class') + '' + disabledClassName);
        }


    };

    //Support function: checks to see if target
    //element is an object or embed element
    function isObject(targetID) {
        var isFound = false;
        var el = document.getElementById(targetID);

        if (el && (el.nodeName === "OBJECT" || el.nodeName === "EMBED")) {
            isFound = true;
        }

        return isFound;
    }


    function replaceSwfWithEmptyDiv(targetID) {
        if (isObject(targetID)) {
            var el = document.getElementById(targetID);
            if (el) {
                var div = document.createElement("div");
                el.parentNode.insertBefore(div, el);

                //Remove the SWF
                swfobject.removeSWF(targetID);

                //Give the new DIV the old element's ID
                div.setAttribute("id", targetID);
            }
        }
    }
}