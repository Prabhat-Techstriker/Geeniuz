(this["webpackJsonp@coreui/coreui-free-react-admin-template"]=this["webpackJsonp@coreui/coreui-free-react-admin-template"]||[]).push([[11],{654:function(e,t,n){"use strict";function r(e,t){if(null==e)return{};var n,r,o=function(e,t){if(null==e)return{};var n,r,o={},i=Object.keys(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||(o[n]=e[n]);return o}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(o[n]=e[n])}return o}n.d(t,"a",(function(){return r}))},731:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r,o=function(e){if(e&&e.__esModule)return e;if(null===e||"object"!==l(e)&&"function"!==typeof e)return{default:e};var t=u();if(t&&t.has(e))return t.get(e);var n={},r=Object.defineProperty&&Object.getOwnPropertyDescriptor;for(var o in e)if(Object.prototype.hasOwnProperty.call(e,o)){var i=r?Object.getOwnPropertyDescriptor(e,o):null;i&&(i.get||i.set)?Object.defineProperty(n,o,i):n[o]=e[o]}n.default=e,t&&t.set(e,n);return n}(n(1)),i=n(2),a=(r=n(732))&&r.__esModule?r:{default:r};function u(){if("function"!==typeof WeakMap)return null;var e=new WeakMap;return u=function(){return e},e}function l(e){return(l="function"===typeof Symbol&&"symbol"===typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"===typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function c(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function s(e,t){return(s=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function f(e){var t=function(){if("undefined"===typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"===typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,r=y(e);if(t){var o=y(this).constructor;n=Reflect.construct(r,arguments,o)}else n=r.apply(this,arguments);return p(this,n)}}function p(e,t){return!t||"object"!==l(t)&&"function"!==typeof t?d(e):t}function d(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function y(e){return(y=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function h(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var m=function(e){!function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&s(e,t)}(u,e);var t,n,r,i=f(u);function u(e){var t;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,u),h(d(t=i.call(this,e)),"_isMounted",!1),h(d(t),"handleTruncate",(function(e){t._isMounted&&e!==t.state.truncated&&(t.setState({truncated:e}),e&&t.truncateRef.onResize())})),h(d(t),"toggleLines",(function(e){e.preventDefault();var n=d(t);t._isMounted&&t.setState({expanded:!t.state.expanded},(function(){n.props.onClick&&n.props.onClick(n.state.expanded)}))})),t.state={expanded:!1,truncated:!1},t}return t=u,(n=[{key:"componentDidMount",value:function(){this._isMounted=!0,this._isMounted&&this.setState({expanded:this.props.expanded})}},{key:"componentWillUnmount",value:function(){this._isMounted=!1}},{key:"render",value:function(){var e=this,t=this.props,n=t.children,r=t.more,i=t.less,u=t.lines,l=t.anchorClass,c=t.className,s=t.width,f=t.keepNewLines,p=this.state,d=p.expanded,y=p.truncated;return o.default.createElement("div",{className:c},o.default.createElement(a.default,{width:s,lines:!d&&u,ellipsis:o.default.createElement("span",null,"..."," ",o.default.createElement("a",{href:"",className:l,onClick:this.toggleLines},r)),onTruncate:this.handleTruncate,ref:function(t){return e.truncateRef=t}},f?n.split("\n").map((function(e,t,n){return e=o.default.createElement("span",{key:t},e),t===n.length-1?e:[e,o.default.createElement("br",{key:t+"br"})]})):n),!y&&d&&o.default.createElement("span",null," ",o.default.createElement("a",{href:"",className:l,onClick:this.toggleLines},i)))}}])&&c(t.prototype,n),r&&c(t,r),u}(o.Component);h(m,"defaultProps",{lines:3,more:"Show more",less:"Show less",anchorClass:"",onClick:void 0,expanded:!1,width:0,keepNewLines:!1}),h(m,"propTypes",{children:i.PropTypes.node,lines:i.PropTypes.number,more:i.PropTypes.node,less:i.PropTypes.node,anchorClass:i.PropTypes.string,className:i.PropTypes.string,onClick:i.PropTypes.func,expanded:i.PropTypes.bool,width:i.PropTypes.number,keepNewLines:i.PropTypes.bool});var b=m;t.default=b},732:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r=i(n(1)),o=i(n(2));function i(e){return e&&e.__esModule?e:{default:e}}function a(e){return(a="function"===typeof Symbol&&"symbol"===typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"===typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function u(){return(u=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e}).apply(this,arguments)}function l(e,t){if(null==e)return{};var n,r,o=function(e,t){if(null==e)return{};var n,r,o={},i=Object.keys(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||(o[n]=e[n]);return o}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(o[n]=e[n])}return o}function c(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function s(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function f(e,t){return(f=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function p(e){var t=function(){if("undefined"===typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"===typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,r=h(e);if(t){var o=h(this).constructor;n=Reflect.construct(r,arguments,o)}else n=r.apply(this,arguments);return d(this,n)}}function d(e,t){return!t||"object"!==a(t)&&"function"!==typeof t?y(e):t}function y(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function h(e){return(h=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function m(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var b=function(e){!function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&f(e,t)}(a,e);var t,n,o,i=p(a);function a(){for(var e,t=arguments.length,n=new Array(t),o=0;o<t;o++)n[o]=arguments[o];return c(this,a),m(y(e=i.call.apply(i,[this].concat(n))),"state",{}),m(y(e),"extractReplaceLinksKeys",(function(t){var n=y(e),r=0;return e.replacedLinks=[],t.replace(/(<a[\s]+([^>]+)>((?:.(?!\<\/a\>))*.)<\/a>)/g,(function(){var e=Array.prototype.slice.call(arguments,1,4);e.key="["+"@".repeat(e[2].length-1)+"="+r+++"]",n.replacedLinks.push(e),t=t.replace(e[0],e.key)})),t})),m(y(e),"restoreReplacedLinks",(function(t){return e.replacedLinks.forEach((function(e){t=t.replace(e.key,e[0])})),e.createMarkup(t)})),m(y(e),"innerText",(function(t){var n=document.createElement("div"),r="innerText"in window.HTMLElement.prototype?"innerText":"textContent",o=t.innerHTML.replace(/\r\n|\r|\n/g," ");n.innerHTML=e.extractReplaceLinksKeys(o);var i=n[r],a=document.createElement("div");return a.innerHTML="foo<br/>bar","foo\nbar"!==a[r].replace(/\r\n|\r/g,"\n")&&(n.innerHTML=n.innerHTML.replace(/<br.*?[\/]?>/gi,"\n"),i=n[r]),i})),m(y(e),"onResize",(function(){e.calcTargetWidth()})),m(y(e),"onTruncate",(function(t){var n=e.props.onTruncate;"function"===typeof n&&(e.timeout=window.requestAnimationFrame((function(){n(t)})))})),m(y(e),"calcTargetWidth",(function(t){var n=y(e),r=n.elements.target,o=n.calcTargetWidth,i=n.canvasContext,a=n.props.width;if(r){var u=a||Math.floor(r.parentNode.getBoundingClientRect().width);if(!u)return window.requestAnimationFrame((function(){return o(t)}));var l=window.getComputedStyle(r),c=[l["font-weight"],l["font-style"],l["font-size"],l["font-family"]].join(" ");i.font=c,e.setState({targetWidth:u},t)}})),m(y(e),"measureWidth",(function(t){return e.canvasContext.measureText(t).width})),m(y(e),"ellipsisWidth",(function(e){return e.offsetWidth})),m(y(e),"trimRight",(function(e){return e.replace(/\s+$/,"")})),m(y(e),"createMarkup",(function(e){return r.default.createElement("span",{dangerouslySetInnerHTML:{__html:e}})})),m(y(e),"getLines",(function(){for(var t=y(e),n=t.elements,o=t.props,i=o.lines,a=o.ellipsis,u=o.trimWhitespace,l=t.state.targetWidth,c=t.innerText,s=t.measureWidth,f=t.onTruncate,p=t.trimRight,d=t.renderLine,h=t.restoreReplacedLinks,m=[],b=c(n.text).split("\n").map((function(e){return e.split(" ")})),v=!0,g=e.ellipsisWidth(e.elements.ellipsis),w=1;w<=i;w++){var O=b[0];if(0!==O.length){var x=O.join(" ");if(s(x)<=l&&1===b.length){v=!1,x=h(x),m.push(x);break}if(w===i){for(var T=O.join(" "),j=0,k=T.length-1;j<=k;){var _=Math.floor((j+k)/2);s(T.slice(0,_+1))+g<=l?j=_+1:k=_-1}var P=T.slice(0,j);if(u)for(P=p(P);!P.length&&m.length;){P=p(m.pop())}"]["===P.substr(P.length-2)&&(P=P.substring(0,P.length-1)),P=h(P=P.replace(/\[(@)\1{2,}$/,"")),x=r.default.createElement("span",null,P,a)}else{for(var E=0,S=O.length-1;E<=S;){var M=Math.floor((E+S)/2);s(O.slice(0,M+1).join(" "))<=l?E=M+1:S=M-1}if(0===E){w=i-1;continue}x=h(x=O.slice(0,E).join(" ")),b[0].splice(0,E)}m.push(x)}else m.push(),b.shift(),w--}return f(v),m.map(d)})),m(y(e),"renderLine",(function(e,t,n){if(t===n.length-1)return r.default.createElement("span",{key:t},e);var o=r.default.createElement("br",{key:t+"br"});return e?[r.default.createElement("span",{key:t},e),o]:o})),m(y(e),"styles",{ellipsis:{position:"fixed",visibility:"hidden",top:0,left:0}}),e.elements={},e.replacedLinks=[],e}return t=a,(n=[{key:"componentDidMount",value:function(){var e=this.elements.text,t=this.calcTargetWidth,n=this.onResize,r=document.createElement("canvas");this.canvasContext=r.getContext("2d"),t((function(){e&&e.parentNode.removeChild(e)})),window.addEventListener("resize",n)}},{key:"componentDidUpdate",value:function(e){this.props.children!==e.children&&this.forceUpdate(),this.props.width!==e.width&&this.calcTargetWidth()}},{key:"componentWillUnmount",value:function(){var e=this.elements.ellipsis,t=this.onResize,n=this.timeout;e.parentNode.removeChild(e),window.removeEventListener("resize",t),window.cancelAnimationFrame(n)}},{key:"render",value:function(){var e,t=this,n=this.elements.target,o=this.props,i=o.children,a=o.ellipsis,c=o.lines,s=l(o,["children","ellipsis","lines"]),f=this.state.targetWidth,p=this.getLines,d=this.onTruncate;return"undefined"!==typeof window&&!(!n||!f)&&(c>0?e=p():(e=i,d(!1))),delete s.onTruncate,delete s.trimWhitespace,r.default.createElement("span",u({},s,{ref:function(e){t.elements.target=e}}),r.default.createElement("span",null,e),r.default.createElement("span",{ref:function(e){t.elements.text=e}},i),r.default.createElement("span",{ref:function(e){t.elements.ellipsis=e},style:this.styles.ellipsis},a))}}])&&s(t.prototype,n),o&&s(t,o),a}(r.default.Component);t.default=b,m(b,"propTypes",{children:o.default.node,ellipsis:o.default.node,lines:o.default.oneOfType([o.default.oneOf([!1]),o.default.number]),trimWhitespace:o.default.bool,width:o.default.number,onTruncate:o.default.func}),m(b,"defaultProps",{children:"",ellipsis:"\u2026",lines:1,trimWhitespace:!1,width:0})},733:function(e,t,n){"use strict";e.exports=n(734)},734:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r=a(n(1)),o=a(n(2)),i=a(n(735));function a(e){return e&&e.__esModule?e:{default:e}}function u(e){return(u="function"===typeof Symbol&&"symbol"===typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"===typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function l(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if(!(Symbol.iterator in Object(e))&&"[object Arguments]"!==Object.prototype.toString.call(e))return;var n=[],r=!0,o=!1,i=void 0;try{for(var a,u=e[Symbol.iterator]();!(r=(a=u.next()).done)&&(n.push(a.value),!t||n.length!==t);r=!0);}catch(l){o=!0,i=l}finally{try{r||null==u.return||u.return()}finally{if(o)throw i}}return n}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}()}function c(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function s(e,t){return!t||"object"!==u(t)&&"function"!==typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function f(e){return(f=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function p(e,t){return(p=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var d=function(e){function t(e){var n;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);var r=[(n=s(this,f(t).call(this,e))).props.text,n.props.min,n.props.ideal,n.props.max],o=l(i.default.apply(void 0,r),2),a=o[0],u=o[1];return n.state={displaySecondary:!1,primaryText:a,secondaryText:u,readMoreText:n.props.readMoreText},n}var n,o,a;return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&p(e,t)}(t,e),n=t,(o=[{key:"setStatus",value:function(){var e=!this.state.displaySecondary;this.setState({displaySecondary:e})}},{key:"render",value:function(){return this.state.secondaryText?this.state.displaySecondary?r.default.createElement("div",{className:"display-text-group"},r.default.createElement("span",{className:"displayed-text",onClick:this.setStatus.bind(this)},"".concat(this.state.primaryText," ").concat(this.state.secondaryText))):r.default.createElement("div",{className:"display-text-group"},r.default.createElement("span",{className:"displayed-text"},this.state.primaryText,r.default.createElement("span",{style:{display:"none"}},this.state.secondaryText),r.default.createElement("div",{className:"read-more-button",onClick:this.setStatus.bind(this)},this.state.readMoreText))):r.default.createElement("div",{className:"display-text-group"},r.default.createElement("span",{className:"displayed-text"},"".concat(this.state.primaryText," ").concat(this.state.secondaryText)))}}])&&c(n.prototype,o),a&&c(n,a),t}(r.default.Component);t.default=d,d.propTypes={text:o.default.string.isRequired,min:o.default.number,ideal:o.default.number,max:o.default.number,readMoreText:o.default.string},d.defaultProps={readMoreText:"read more"}},735:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r=[".",",","!","?","'","{","}","(",")","[","]","/"],o=function(e){if(" "===e)return!0},i=function(e,t,n,i){if(e<n&&e>i&&function(e,t){if(r.indexOf(t[e])>=0&&o(t[e+1]))return!0}(e,t))return!0},a=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:80,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:100,r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:200;if(r<t||n>r||n<t)throw new Error("The minimum length must be less than the maximum, and the ideal must be between the minimum and maximum.");if(e.length<n)return[e,""];for(var a,u,l=n,c=n,s=function(t){o(e[t])&&(a=a||t)};l<r||c>t;){if(i(l,e,r,t)){u=l+1;break}if(i(c,e,r,t)){u=c+1;break}s(l),s(c),l++,c--}return void 0===u&&(u=a&&a>=t&&a<=r?a:n-t<r-n?t:r),[e.slice(0,u),e.slice(u).trim()]};t.default=a}}]);
//# sourceMappingURL=11.da818a2d.chunk.js.map