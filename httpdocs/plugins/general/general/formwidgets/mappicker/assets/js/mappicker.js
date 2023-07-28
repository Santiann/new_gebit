/*
 * MapPicker plugin
 *
 * Esse plugin na realidade é uma interface entre a sua depencia, e os tipos de campos que  october tem.
 *
 * Data attributes:
 * - data-control="mappicker" - enables the plugin on an element
 * - data-radius="value" - an option with a value
 *
 * JavaScript API:
 * $('a#someElement').locationpicker({ option: 'value' })
 *
 * Dependences:
 * - Location Picker (locationpicker.js)
 */

+function ($) { "use strict";

    // MAPPICKER CLASS DEFINITION
    // ============================

    var MapPicker = function(element, options) {
        var self        = this;
        this.options    = options;
        this.$el        = $(element);
        this.editMode       = false;
        this.anyFieldEdited = false;

        this.fields = {
            location        : {'jqobj' : this.$el.find('.location')     , 'alias' : ''},
            street          : {'jqobj' : this.$el.find('.street')       , 'alias' : 'streetName'},
            number          : {'jqobj' : this.$el.find('.number')       , 'alias' : 'streetNumber'},
            district        : {'jqobj' : this.$el.find('.district')       , 'alias' : 'district'},
            city            : {'jqobj' : this.$el.find('.city')         , 'alias' : 'city'},
            state           : {'jqobj' : this.$el.find('.state')        , 'alias' : 'stateOrProvince'},
            zip             : {'jqobj' : this.$el.find('.zip')          , 'alias' : 'postalCode'},
            country         : {'jqobj' : this.$el.find('.country')      , 'alias' : 'country'},
            latitude        : {'jqobj' : this.$el.find('.latitude')     , 'alias' : 'latitude' , 'update' : false},
            longitude       : {'jqobj' : this.$el.find('.longitude')    , 'alias' : 'longitude', 'update' : false},
            mapCanvas       : {'jqobj' : this.$el.find('.mapcanvas')    , 'alias' : 'mapcanvas', 'update' : false}
        }

        this.onStartup();

    };

    MapPicker.DEFAULTS = {
        refreshHandler: null,
        dataLocker: null
    };

    MapPicker.prototype.onStartup = function()
    {
        if(this.fields.country.jqobj.val() != ''){
            this.editMode = true;
        }

        this.bindPlugin();
        this.bindUpdatedStatus();
    }

    /**
     * Função para bindar o plugin no elemento selecionado
     */
    MapPicker.prototype.bindPlugin = function()
    {
        var self = this;

        this.fields.mapCanvas.jqobj.locationpicker({
            location: {latitude: self.options.latitude, longitude: self.options.longitude},
            radius: self.options.radius,
            inputBinding: {
                locationNameInput   : self.fields.location.jqobj,
                latitudeInput       : self.fields.latitude.jqobj,
                longitudeInput      : self.fields.longitude.jqobj
            },
            enableAutocomplete : true,
            enableReverseGeocode : true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                var addressComponents = $(this).locationpicker('map').location.addressComponents;
                self.updateControls(addressComponents);
            },
            oninitialized: function(component) {
                var addressComponents = $(component).locationpicker('map').location.addressComponents;
                self.updateControls(addressComponents);
            }
        });

    }

    /**
     * Atualiza todos os campos de texto com o retorno do geocodding
     * menos caso o campo já esteja em modo de edição.
     * @param addressComponents
     */
    MapPicker.prototype.updateControls = function(addressComponents){

        //Irá substituir
        var overWrite = true;

        //Se houveram modificações, perguntar
        if(this.anyFieldEdited) {
            overWrite = (confirm('O endereco foi editado manualmente, selecionar um novo fara voce perder as alteracoes. Deseja continuar'));
        }

        if(overWrite && (!this.editMode)){

            //Laço para todos os campos, Aioooo Silver...
            for (var indexName in this.fields) {

                var object = this.fields[indexName].jqobj;
                var value = this.fields[indexName].alias;
                var update = true;

                if(typeof this.fields[indexName].update !== 'undefined'){
                    update = this.fields[indexName].update;
                }

                if(update)
                {
                    object.val(addressComponents[value]);
                }

            }

            this.$el.find('[data-edited]').attr('data-edited',false);
        }

        this.editMode = false;
    };

    /**
     * Anexa a função quando qualquer tecla for pressionada no campo de texto do endereco
     */
    MapPicker.prototype.bindUpdatedStatus = function()
    {
        for (var indexName in this.fields) {

            var self = this;
            var selfField = this.fields[indexName].jqobj;

            selfField.keyup(function(){
                //$(this).attr('data-edited',true);
                self.anyFieldEdited = true;
            });
        }

    };


    // MAPPICKER PLUGIN DEFINITION
    // ============================

    var old = $.fn.mapPicker;

    $.fn.mapPicker = function (option) {

        var args = Array.prototype.slice.call(arguments, 1), result;
        this.each(function () {
            var $this   = $(this);
            var options = $.extend({}, MapPicker.DEFAULTS, $this.data(), typeof option == 'object' && option);

            var data = new MapPicker(this, options);
            if (typeof option == 'string') result = data[option].apply(data, args);
            if (typeof result != 'undefined') return false
        });

        return result ? result : this
    };

    $.fn.mapPicker.Constructor = MapPicker;

    // MAPPICKER NO CONFLICT
    // =================
    $.fn.mapPicker.noConflict = function () {
        $.fn.mapPicker = old;
        return this
    };

    // MAPPICKER DATA-API
    // ===============
    $(document).render(function () {

        $('[data-control="mappicker"]').mapPicker();

    })

}(window.jQuery);
