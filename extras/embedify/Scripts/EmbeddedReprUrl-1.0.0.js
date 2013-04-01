$(function () {
    var embeddedReprUrl = new EmbeddedReprUrl();
    embeddedReprUrl.Init(".embeddor");
});


function EmbeddedReprUrl() {
    var uIInteractions = new uiInteractions();

    this.TryToEmbedUrl = function (el) {
        if (el == null) return;

        var dynaElement = new dynaElementsManager(el);
        dynaElement.Create();
        var firstUrlParsed = $(el).val().parseFirstUrl();
        if (firstUrlParsed == "") {
            dynaElement.Close();
            return;
        }

        var lastUrlEmbeddedValue = dynaElement.LastUrlKeeper().val();
        if (lastUrlEmbeddedValue != firstUrlParsed) {
            //start animation
            dynaElement.ShowProgress();
            callService(el, firstUrlParsed, dynaElement);
        }
    };

    function callService(el, url, dynaElement) {
        dynaElement.LastUrlKeeper().val(url);
        var embedifyMeConfiguration = new EmbedifyMeConfiguration();

        jQuery.getJSON(embedifyMeConfiguration.serviceUrl,
        {
            domain: encodeURIComponent(window.location),
            url: url,
            key: embedifyMeConfiguration.domainKey,
            w: $(el).width() - 30
        },
        function (data) {
            if (data.EM != null) {
                alert(data.EM);
                return;
            }
            getEmbeddedUrlRepresentation(data, dynaElement);
        });
    }

    function getEmbeddedUrlRepresentation(data, dynaElement) {

        //I forgot why I was making these 2 checks, maybe in case that user closes the preview 
        //and continues writing and not wanting to see the preview box, for which these 2 lines will not help!
        if (!dynaElement.Present()) return;
        if (!dynaElement.NextElement().is(":visible")) return;

        var embedifyMeConfiguration = new EmbedifyMeConfiguration();
        var xmlText = data2Xml(data);

        //http://archive.plugins.jquery.com/project/Transform
        dynaElement.ContentElement().transform({ async: false, xmlstr: xmlText, xsl: embedifyMeConfiguration.xslFile });
        dynaElement.DecodeContentElement();

        dynaElement.LoadingPanel().hide();
        dynaElement.ContentElement().show();

        dynaElement.SetOriginalContentElement();

        if (dynaElement.ContentElement().html() == "") {
            dynaElement.Close();
        }

        var embeddedRepresentationXsl = new EmbeddedRepresentationXsl();
        embeddedRepresentationXsl.Initialize(setOriginalContentElement, dynaElement);

    }

    function setOriginalContentElement(dynaElement) {
        dynaElement.SetOriginalContentElement();
    }

    function data2Xml(data) {
        var pictures = "";
        var pictureUrls = "";
        var pictureWidths = "";
        var pictureHeights = "";
        if (data.PR == null) return null;

        if (data.PR.Pictures != null) {

            for (var pictureIndexor = 0; pictureIndexor < data.PR.Pictures.length; pictureIndexor++) {
                var picture = data.PR.Pictures[pictureIndexor];
                pictures += "<PagePicture>" +
                                "<Url><![CDATA[" + picture.Url + "]]></Url>" +
                                "<Alt><![CDATA[" + picture.Alt + "]]></Alt>" +
                                "<Width>" + picture.Width + "</Width>" +
                                "<Height>" + picture.Height + "</Height>" +
                           "</PagePicture>";
                pictureUrls += picture.Url + "*";
                pictureWidths += picture.Width + "*";
                pictureHeights += picture.Height + "*";

            }

        }

        var videos = "";
        if (data.PR.Videos != null) {
            for (var videoIndexor = 0; videoIndexor < data.PR.Videos.length; videoIndexor++) {
                var videoSources = "<PageVideoSources>";
                var video = data.PR.Videos[videoIndexor];
                for (var videoSourceIndexor = 0; videoSourceIndexor < video.VideoSources.length; videoSourceIndexor++) {
                    var videoSource = video.VideoSources[videoSourceIndexor];
                    videoSources += "<Url><![CDATA[" + videoSource.Url + "]]></Url>";
                    videoSources += "<VideoMimeType><![CDATA[" + videoSource.VideoMimeType + "]]></VideoMimeType>";
                    videoSources += "<VideoType><![CDATA[" + videoSource.VideoMimeType + "]]></VideoType>";
                }
                videoSources += "</PageVideoSources>";
                videos += "<PageVideo>" +
                                "<PlayerId><![CDATA[" + video.PlayerId + "]]></PlayerId>" +
                                "<Alt><![CDATA[" + video.Alt + "]]></Alt>" +
                                "<Width>" + video.Width + "</Width>" +
                                "<Height>" + video.Height + "</Height>" +
                                "<MaxWidth>" + video.MaxWidth + "</MaxWidth>" +
                                "<MaxHeight>" + video.MaxHeight + "</MaxHeight>" +
                                "<UsedWidth>" + video.UsedWidth + "</UsedWidth>" +
                                "<UsedHeight>" + video.UsedHeight + "</UsedHeight>" +
                                "<ContainerStyle>" + video.ContainerStyle + "</ContainerStyle>" +
                                "<Html><![CDATA[" + escape(video.Html) + "]]></Html>" +
                                "<VideoSources>" + videoSources + "</VideoSources>" +
                          "</PageVideo>";

            }
        }

        var embedifyMeConfiguration = new EmbedifyMeConfiguration();
        var xmlText = "<PageRepresentation>" +
                    "<Url><![CDATA[" + data.PR.Url + "]]></Url>" +
                    "<Domain><![CDATA[" + data.PR.Domain + "]]></Domain>" +
                    "<Title><![CDATA[" + data.PR.Title + "]]></Title>" +
                    "<Description><![CDATA[" + data.PR.Description + "]]></Description>" +
                    "<Pictures>" +
                       pictures +
                       "<PictureUrls><![CDATA[" +
                            pictureUrls +
                            "]]>" +
                       "</PictureUrls>" +
                       "<PictureWidths>" +
                            pictureWidths +
                       "</PictureWidths>" +
                       "<PictureHeights>" +
                            pictureHeights +
                       "</PictureHeights>" +
                    "</Pictures>" +
                    "<Videos>" +
                       videos +
                    "</Videos>" +
                    "<AuthorName>" + (data.PR.AuthorName == null ? "" : "<![CDATA[" + data.PR.AuthorName + "]]>") + "</AuthorName>" +
                     "<PlayIcon><![CDATA[" + escape(embedifyMeConfiguration.playIcon) + "]]></PlayIcon>" +
                     "<BlankIcon><![CDATA[" + escape(embedifyMeConfiguration.blankIcon) + "]]></BlankIcon>" +
                     "<PrevThumbIcon><![CDATA[" + escape(embedifyMeConfiguration.prevThumbIcon) + "]]></PrevThumbIcon>" +
                     "<NextThumbIcon><![CDATA[" + escape(embedifyMeConfiguration.nextThumbIcon) + "]]></NextThumbIcon>" +
                   "</PageRepresentation>";
        return xmlText;
    };
    this.Init = function (selector) {

        uIInteractions.BindInputEvents(selector, this.TryToEmbedUrl);
    };

    this.CloseEmbedView = function (el) {
        var dynaElement = new dynaElementsManager(el);
        dynaElement.Close();
    }; //Get just the embedded content which is shown on preview area 
    this.GetEmbeddedContent = function (el) {
        var dynaElement = new dynaElementsManager(el);
        if (dynaElement.Present()) {
            var contentContainer = dynaElement.OriginalContentElement();
            if (contentContainer == null) return "";
            return unescape(contentContainer.val()).replace(/(\r\n|\n|\r)/gm, "");
        }
        return "";
    };

    //Get all content with url replaced by preview
    this.GetFullContent = function (el) {
        var allText = $(el).val();
        var embeddedContent = this.GetEmbeddedContent(el);
        if (embeddedContent == "") return allText;

        var dynaElement = new dynaElementsManager(el);
        var urlembeddedValue = dynaElement.LastUrlKeeper().val();
        return allText.replace(urlembeddedValue, embeddedContent);
    };

    function dynaElementsManager(baseElement) {
        var embedifyMeConfiguration = new EmbedifyMeConfiguration();
        var dynaElementsWrapperClass = "embeddedUrlRepresentationWrapper";
        var loadingText = embedifyMeConfiguration.loadingText;
        var closeButtonText = embedifyMeConfiguration.closeButtonTip;

        this.Present = function () {

            var dynaElementsPresent = this.NextElement().is('div') && this.NextElement().attr('class') == dynaElementsWrapperClass;
            return dynaElementsPresent;
        };

        this.NextElement = function () {

            return $(baseElement).next();
        };

        this.LastUrlKeeper = function () {
            return this.NextElement().children(":last-child");
        };

        this.LoadingPanel = function () {
            return this.NextElement().children(":first-child");
        };
        this.ContentElement = function () {
            return this.NextElement().children(":nth-child(2)");
        };

        this.DecodeContentElement = function () {
            if (this.ContentElement().html().indexOf("&lt;") > -1) {//if html needs html decoding
                var decoded = $("<div/>").html(this.ContentElement().html()).text();
                this.ContentElement().html(decoded);
            }
        };

        this.OriginalContentElement = function () {
            return this.NextElement().children(":nth-child(4)");
        };

        this.SetOriginalContentElement = function () {
            this.OriginalContentElement().val(escape(this.ContentElement().outerHtml()));
        };
        this.CloseButton = function () {
            return this.NextElement().children(":nth-child(3)").children(":first-child");
        };
        this.CloseButtonWidth = function () {
            return 30;
        };

        this.Create = function () {
            if (this.Present()) return;

            var contentWidth = $(baseElement).width() - this.CloseButtonWidth();
            $(baseElement).after("<div style='width:" + ($(baseElement).outerWidth() - 22) + "px;' class='" + dynaElementsWrapperClass + "'>" +
                "<div style=\'background:url(\"" + escape(embedifyMeConfiguration.loadingIcon) + "\")  no-repeat 15px 15px;width:" + (contentWidth - 100) + "px;\' class='embeddedUrlRepresentationLoader'>" + loadingText + "</div>" +
                "<div style='width:" + contentWidth + "px;' class='embeddedRepresentationContent'></div>" +
                "<div class='embeddedRepresentationClose' style=\'background:url(\"" + escape(embedifyMeConfiguration.closeIcon) + "\") no-repeat 3px 4px;width:" + this.CloseButtonWidth() + "px'>" +
                "<a href='#' title='" + closeButtonText + "'>" + closeButtonText + "</a></div>" +
                "<input type='hidden' /><div style='clear:both;'></div><input type='hidden' /></div>");

            var tempThis = this; //for the close function, not to have confusion of 'this', bcz within the function, x refers to the close button itselft, not this instance
            this.CloseButton().click(function () {
                tempThis.Close();
            });
        };


        this.Close = function () {
            if (!this.Present()) return;

            this.LastUrlKeeper().val("");
            this.ContentElement().html("");
            this.LoadingPanel().hide();
            this.OriginalContentElement().val("");
            this.NextElement().hide();
        };

        this.ShowProgress = function () {
            if (!this.Present()) return;

            this.LoadingPanel().show();
            this.ContentElement().hide();
            this.NextElement().show();
            this.ContentElement().html("");
        };
    };

    function uiInteractions() {

        this.BindInputEvents = function (selector, func) {
            if (jQuery.browser.opera) {
                $(selector).bind('input', function (e) {
                    var tempEditedElement = $(this); //this is needed for opera, it is forgetting $(this) after timeout
                    setTimeout(function () {
                        func(tempEditedElement);
                    }, 100);
                });
            } else {
                $(selector).keyup(function (event) {
                    var embeddingTriggeringKeyCodes = new Array(8, 13, 32, 45, 46, 86, 88);
                    if ($.inArray(event.keyCode, embeddingTriggeringKeyCodes) > -1) {
                        func($(this));
                    }
                });
                $(selector).bind('cut paste delete drop', function (e) {
                    setTimeout(function () {
                        func($(this));
                    }, 100);
                });
            }

        };

    };

}

//this has to be a public function, to enable the youtube videos auto-play
function onYouTubePlayerReady(playerId) {
    ytplayer = document.getElementById(playerId);
    ytplayer.playVideo();
}

//this is for the jwplayer(.flv) movies to auto-play
function jwPlayerFlashLoaded(e) {
    // Interact with the player
    jwplayer(e.ref).play();
}


//jquery extensions

jQuery.fn.bestFitOrCenterize = function (doBestFit, doCenterize, centerizeIn, callBackFunc, dynaElement) {
    return this.each(function () {
        $(this).hide();
        $(this).load(
                function () {
                    if (doBestFit) {
                        $(this).bestFitImage();
                    }
                    if (doCenterize) {
                        if (centerizeIn != null) {
                            $(this).centerizeImage(centerizeIn);
                        } else {
                            $(this).centerizeImage();
                        }
                    }
                    $(this).show();
                    if (callBackFunc) callBackFunc(dynaElement);
                }
            );
    });
};


jQuery.fn.bestFitImage = function (maxWidth, maxHeight) {
    return this.each(function () {
        if (maxWidth == null && $(this).parent() != null) maxWidth = $(this).parent().width();
        if (maxHeight == null && $(this).parent() != null) maxHeight = $(this).parent().height();
        var w = $(this).width();
        var h = $(this).height();
        if (w <= maxWidth && h <= maxHeight) return;
        var ratio = w / h;
        w = maxWidth;
        h = Math.floor(maxWidth / ratio);
        if (h > maxHeight) {
            h = maxHeight;
            w = Math.floor(maxHeight * ratio);
        }
        $(this).width(w);
        $(this).height(h);
    });
};


jQuery.fn.centerizeImage = function (container) {
    return this.each(function () {
        if (container == null) container = $(this).parent();
        if (container == null) return;

        var ph = container.height();
        var h = $(this).height();
        var mt = (ph - h) / 2;

        var pw = container.width();
        var w = $(this).width();
        var ml = (pw - w) / 2;

        $(this).css('marginTop', mt + 'px');
        $(this).css('marginLeft', ml + 'px');


    });
};

jQuery.fn.extend({ outerHtml: function (replacement) {
    // We just want to replace the entire node and contents with
    // some new html value
    if (replacement) {
        return this.each(function () { $(this).replaceWith(replacement); });
    }

    var tmpNode = $("<div></div>").append($(this).clone());
    var markup = tmpNode.html();

    // Don't forget to clean up or we will leak memory.
    tmpNode.remove();
    return markup;
}
});


//string class extensions
String.prototype.trim = function () {
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
};
String.prototype.parseFirstUrl = function () {

    var urlRegexp = /(((ftp|http|https):\/\/)|www\.)(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    var firstUrlParsed = "";
    var words = this.split(" ");
    for (var wordsIndex = 0; wordsIndex < words.length; wordsIndex++) {
        var word = words[wordsIndex].trim();
        if (word != "") {
            var array = word.match(urlRegexp);
            if (array != null) {
                firstUrlParsed = array[0];
                break;
            }
        }
    }
    return firstUrlParsed;
};



