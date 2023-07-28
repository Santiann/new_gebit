/*
 * JsonMediaFinder plugin
 *
 * Data attributes:
 * - data-control="mediafinder" - enables the plugin on an element
 * - data-option="value" - an option with a value
 *
 * JavaScript API:
 * $('a#someElement').recordFinder({ option: 'value' })
 *
 * Dependences:
 * - Some other plugin (filename.js)
 */

+function ($) { "use strict";
    var Base = $.oc.foundation.base,
        BaseProto = Base.prototype

    var JsonMediaFinder = function (element, options) {
        this.$el = $(element)
        this.options = options || {}

        $.oc.foundation.controlUtils.markDisposable(element)
        Base.call(this)
        this.init()
    }

    JsonMediaFinder.prototype = Object.create(BaseProto)
    JsonMediaFinder.prototype.constructor = JsonMediaFinder

    JsonMediaFinder.prototype.init = function() {
        if (this.options.isMulti === null) {
            this.options.isMulti = this.$el.hasClass('is-multi')
        }

        if (this.options.isImage === null) {
            this.options.isImage = this.$el.hasClass('is-image')
        }

        this.$template              = $('.template-new-item',this.$el);
        this.$filesContainer        = $('.upload-files-container', this.$el)
        this.$el.on('click', '.find-button', this.proxy(this.onClickFindButton))
        this.$el.on('click', '.find-remove-button', this.proxy(this.onClickRemoveButton))
        this.$el.one('dispose-control', this.proxy(this.dispose))

        this.$findValue = $('[data-find-value]', this.$el)
    }

    JsonMediaFinder.prototype.dispose = function() {
        this.$el.off('click', '.find-button', this.proxy(this.onClickFindButton))
        this.$el.off('click', '.find-remove-button', this.proxy(this.onClickRemoveButton))
        this.$el.off('dispose-control', this.proxy(this.dispose))
        this.$el.removeData('oc.jsonmediafinder')

        this.$findValue = null
        this.$el = null

        // In some cases options could contain callbacks, 
        // so it's better to clean them up too.
        this.options = null

        BaseProto.dispose.call(this)
    }

    JsonMediaFinder.prototype.onClickRemoveButton = function() {
        this.$findValue.val('')
        this.evalIsPopulated()
    }

    JsonMediaFinder.prototype.replaceAll = function(string, find, replace) {
        find = find.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
        return string.replace(new RegExp(find, 'g'), replace);
    }

    JsonMediaFinder.prototype.onClickFindButton = function() {
        var self = this

        new $.oc.mediaManager.popup({
            alias: 'ocmediamanager',
            cropAndInsertButton: false,
            onInsert: function(items) {
                if (!items.length) {
                    alert('Please select image(s) to insert.')
                    return
                }

                $('.no-images',self.$el).hide();

                var path, publicUrl,titleImage,thumb
                for (var i=0, len=items.length; i<len; i++) {

                    path        = items[i].path;
                    publicUrl   = items[i].publicUrl;
                    titleImage  = items[i].title;

                    var documentType = items[i]['documentType'];

                    if(documentType == 'audio'){
                        thumb = '<i style="margin: 18px" class="icon-music"></i>';

                    }else if (documentType == 'image'){
                        thumb = '<img src="'+publicUrl+'" />';

                    }else if(documentType == 'video'){
                        thumb = '<i style="margin: 18px" class="icon-video-camera"></i>';

                    }else{
                        thumb = '<i style="margin: 18px" class="icon-file"></i>';
                    }

                    var $htmlTemplate = self.$template.html();
                    $htmlTemplate = self.replaceAll($htmlTemplate,'[[file_location]]',  publicUrl);
                    $htmlTemplate = self.replaceAll($htmlTemplate,'[[file_name]]',      titleImage);
                    $htmlTemplate = self.replaceAll($htmlTemplate,'[[file_value]]',     path);
                    $htmlTemplate = self.replaceAll($htmlTemplate,'[[file_thumb]]',     thumb);

                    self.$filesContainer.append($htmlTemplate);
                }

                self.$findValue.val(path)

                if (self.options.isImage) {
                    $('[data-find-image]', self.$el).attr('src', publicUrl)
                }

                //self.evalIsPopulated()

                this.hide()
            }
        })

    }

    JsonMediaFinder.prototype.evalIsPopulated = function() {
        var isPopulated = !!this.$findValue.val()
        this.$el.toggleClass('is-populated', isPopulated)

        console.log(this.$findValue.val());

        $('[data-find-file-name]', this.$el).text(this.$findValue.val().substring(1))
    }

    JsonMediaFinder.DEFAULTS = {
        isMulti: null,
        isImage: null
    }

    // PLUGIN DEFINITION
    // ============================

    var old = $.fn.jsonmediafinder

    $.fn.jsonmediafinder = function (option) {
        var args = arguments;

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.jsonmediafinder')
            var options = $.extend({}, JsonMediaFinder.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.jsonmediafinder', (data = new JsonMediaFinder(this, options)))
            if (typeof option == 'string') data[option].apply(data, args)
        })
      }

    $.fn.jsonmediafinder.Constructor = JsonMediaFinder

    $.fn.jsonmediafinder.noConflict = function () {
        $.fn.jsonmediafinder = old
        return this
    }

    $(document).render(function (){
        $('[data-control="jsonmediafinder"]').jsonmediafinder()
        $( '[data-sortable]' ).sortable();
        $( '[data-sortable]' ).disableSelection();
    })

}(window.jQuery);
