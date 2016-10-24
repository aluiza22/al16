(function($, window){

    jQuery(document).ready(function($){

        (function(mod) {
            if (typeof exports == "object" && typeof module == "object") // CommonJS
                mod(require("../../lib/codemirror"))
            else if (typeof define == "function" && define.amd) // AMD
                define(["../../lib/codemirror"], mod)
            else // Plain browser env
                mod(CodeMirror)
        })(function(CodeMirror) {
            "use strict"

            CodeMirror.defineOption("autoRefresh", false, function(cm, val) {
                if (cm.state.autoRefresh) {
                    stopListening(cm, cm.state.autoRefresh)
                    cm.state.autoRefresh = null
                }
                if (val && cm.display.wrapper.offsetHeight == 0)
                    startListening(cm, cm.state.autoRefresh = {delay: val.delay || 250})
            })

            function startListening(cm, state) {
                function check() {
                    if (cm.display.wrapper.offsetHeight) {
                        stopListening(cm, state)
                        if (cm.display.lastWrapHeight != cm.display.wrapper.clientHeight)
                            cm.refresh()
                    } else {
                        state.timeout = setTimeout(check, state.delay)
                    }
                }
                state.timeout = setTimeout(check, state.delay)
                state.hurry = function() {
                    clearTimeout(state.timeout)
                    state.timeout = setTimeout(check, 50)
                }
                CodeMirror.on(window, "mouseup", state.hurry)
                CodeMirror.on(window, "keyup", state.hurry)
            }

            function stopListening(_cm, state) {
                clearTimeout(state.timeout)
                CodeMirror.off(window, "mouseup", state.hurry)
                CodeMirror.off(window, "keyup", state.hurry)
            }
        });

        var cufpnCssEditor = document.getElementById('custom_css');

        var cufpnCodeMirror = CodeMirror.fromTextArea(cufpnCssEditor, {
            mode: 'css',
            theme: '3024-day',
            autorefrsh:true,
            lineNumbers: true,
            lineWrapping : false,autoRefresh:true,
            styleActiveLine: true,fixedGutter:true,
            lint:true, coverGutterNextToScrollbar:false,
            gutters: ['CodeMirror-lint-markers']

        });
        cufpnCodeMirror.setSize(1000, 100);
    });

})( jQuery, window );