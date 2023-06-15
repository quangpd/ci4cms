if (document.all && !window.setTimeout.isPolyfill) {
  var __nativeST__ = window.setTimeout;
  window.setTimeout = function (
    vCallback,
    nDelay /*, argumentToPass1, argumentToPass2, etc. */
  ) {
    var aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeST__(
      vCallback instanceof Function
        ? function () {
            vCallback.apply(null, aArgs);
          }
        : vCallback,
      nDelay
    );
  };
  window.setTimeout.isPolyfill = true;
}

if (document.all && !window.setInterval.isPolyfill) {
  var __nativeSI__ = window.setInterval;
  window.setInterval = function (
    vCallback,
    nDelay /*, argumentToPass1, argumentToPass2, etc. */
  ) {
    var aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeSI__(
      vCallback instanceof Function
        ? function () {
            vCallback.apply(null, aArgs);
          }
        : vCallback,
      nDelay
    );
  };
  window.setInterval.isPolyfill = true;
}

$(function () {});
// Path: public/backend/js/demo.js
