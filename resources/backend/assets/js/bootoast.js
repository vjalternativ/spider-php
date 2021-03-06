/**
 * Plugin for displaying floating Bootstrap 3 `.alert`s.
 * 
 * @author odahcam
 * @version 1.0.0
 */
;
(function($, window, document, undefined) {

    "use strict";

    if (!$) {
        console.error("jQuery não encontrado, seu plugin jQuery não irá funcionar.");
        return false;
    }

    /**
	 * Store the plugin name in a variable. It helps you if later decide to
	 * change the plugin's name
	 * 
	 * @type {string} pluginName
	 */
    var pluginName = 'bootoast';

    /*
	 * The plugin constructor.
	 */
    function BootstrapNotify(options) {

        if (options !== undefined) {

            // Variables default
            this.settings = $.extend({}, this.defaults);

            // Checa se foi passada uma mensagem flat ou se há opções.
            if (typeof options !== 'string') {
                $.extend(this.settings, options);
            } else {
                this.settings.message = options;
            }

            this.content = this.settings.content || this.settings.text || this.settings.message;

            // Define uma posição suportada para o .alert
            if (this.positionSupported[this.settings.position] === undefined) {
                // Tenta encontrar um sinônimo
                var positionCamel = $.camelCase(this.settings.position);

                if (this.positionSinonym[positionCamel] !== undefined) {
                    this.settings.position = this.positionSinonym[positionCamel] || 'bottom-center';
                }
            }

            var position = this.settings.position.split('-'),
                positionSelector = '.' + position.join('.'),
                positionClass = position.join(' ');

            // Define se o novo .alert deve ser inserido por primeiro ou último
			// no container.
            this.putTo = position[0] == 'bottom' ? 'appendTo' : 'prependTo';

            // Define o .glyphicon com base no .alert-<type>
            this.settings.icon = this.settings.icon || this.icons[this.settings.iconsource][this.settings.type];

            var containerClass = pluginName + '-container';

            // Checa se já tem container, se não cria um.
            if ($('body > .' + containerClass + positionSelector).length === 0) {
                $('<div class="' + containerClass + ' ' + positionClass + '"></div>').appendTo('body');
            }

            // Adiciona o .alert ao .container conforme seu posicionamento.
            this.$el = $('<div class="alert alert-' + this.settings.type + ' ' + pluginName + '"><span class="'+this.settings.iconsource+' '+this.settings.iconsource+'-' + this.settings.icon + ' pull-left"></span><span class="bootoast-alert-container pull-left"><span class="bootoast-alert-content">' + this.content + '</span></span><div class="clearfix"></div></div>')[this.putTo]('.' + containerClass + positionSelector);

            if (this.settings.dismissable === true) {
                this.$el
                    .addClass('alert-dismissable')
                    .prepend('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>');
            }

            // Exibe o .alert
            this.$el.animate({
                opacity: 1,
            }, this.settings.animationDuration);

            // Se o .alert tem tempo de expiração
            if (this.settings.timeout !== false) {
                var secondsTimeout = parseInt(this.settings.timeout * 1000),
                    timer = this.hide(secondsTimeout),
                    plugin = this;

                // Pausa o timeout baseado no hover
                this.$el.hover(
                    clearTimeout.bind(window, timer),
                    function() {
                        timer = plugin.hide(secondsTimeout);
                    });
            }
        }
    };

    $.extend(BootstrapNotify.prototype, {
        /*
		 * Default options @type {Object} defaults
		 */
        defaults: {
            message: 'Helo!', // String: HTML
            type: 'info', // String: ['warning', 'success', 'danger', 'info']
            position: 'bottom-center', // String: ['top-left', 'top-center',
										// 'top-right', 'bottom-left',
										// 'bottom-center', 'bottom-right']
            icon: undefined, // String: name
            timeout: false,
            animationDuration: 300, // Int: animation duration in miliseconds
            dismissable: true,
            iconsource : "glyphicon"
        },
        /*
		 * Default icons @type {Object} icons
		 */
        icons: {
        	
        	"glyphicon" : {
                warning: 'exclamation-sign',
                success: 'ok-sign',
                danger: 'remove-sign',
                info: 'info-sign'
        		
        	},
        	"fa" : {
                warning: 'warning',
                success: 'check-circle',
                danger: 'times-circle',
                info: 'info-circle'
        		
        	},
        	"ti" : {
        		warning : 'alert',
        		success : 'ti-check-box',
        		danger : 'ti-na',
        		info : 'ti-pin2'
        	}
        	
        },
        /*
		 * Position Sinonymus @type {Object} positionSinonym
		 */
        positionSinonym: {
            bottom: 'bottom-center',
            leftBottom: 'bottom-left',
            rightBottom: 'bottom-right',
            top: 'top-center',
            rightTop: 'top-right',
            leftTop: 'top-left'
        },
        /*
		 * Position Supported @type {array} positionSupported
		 */
        positionSupported: [
            'top-left',
            'top-center',
            'top-right',
            'bottom-left',
            'bottom-right'
        ],
        /**
		 * @type {method} hide
		 * @param {int}
		 *            timeout
		 * @return {int} setTimeoutID The setTimeout ID.
		 */
        hide: function(timeout) {
            var plugin = this;
            return setTimeout(function() {
                plugin.$el.animate({
                    opacity: 0,
                }, plugin.settings.animationDuration, function() {
                    plugin.$el.remove();
                });

				if(plugin.settings.callback) {
					plugin.settings.callback();
				}
            }, timeout || 0);
        }
    });

    window[pluginName] = function(options) {
        return new BootstrapNotify(options);
    };

})(window.jQuery || false, window, document);





class BSToast  {	
	toastOption =  {
			  message:"Toast message",
			  timeout:4,
			  position: 'bottom-right',
			  dismissable: false,
			  type : 'success',
			  iconsource : 'glyphicon'
	}
	
	static instance = null;
	constructor(iconsource=false){
		if(iconsource) {
			this.toastOption.iconsource = iconsource;
		}
	}
	toast = (type,message,callback=false) => {
		var option = this.toastOption;
		option.message = message;
		option.type=type;
		option.callback = callback;
		bootoast(option);	
	}
	static getInstance(iconsource) {
		if(this.instance==null) {
			this.instance = new BSToast(iconsource);
		}
		return this.instance;
	}
	
	
	success = message => {
		this.toast("success",message);
	}
	
	warning = message => {
		this.toast("warning",message);
	}
	
	danger = message => {
		this.toast("danger",message);
	}
	
	info = message => {
		this.toast("info",message);
	}
}


class BS4Toast extends BSToast {
	static toast = (type,message,callback=false) => {
		var toast = this.getInstance("fa");
		toast.toast(type,message,callback);
	}
	
}

class TyBSToast extends BSToast {
	static toast = (type,message) => {
		var toast = this.getInstance("ti");
		toast.toast(type,message);
	}
}
