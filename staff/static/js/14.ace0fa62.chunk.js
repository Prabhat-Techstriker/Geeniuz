(this["webpackJsonp@coreui/coreui-free-react-admin-template"]=this["webpackJsonp@coreui/coreui-free-react-admin-template"]||[]).push([[14],{653:function(e,t,n){"use strict";var r=n(654),a=n(1),o=n.n(a),c=n(642);o.a.memo((function(e){var t=e.name,n=e.text,a=Object(r.a)(e,["name","text"]),l=t?"https://coreui.io/react/docs/components/".concat(t):e.href;return o.a.createElement("div",{className:"card-header-actions"},o.a.createElement(c.J,Object.assign({},a,{href:l,rel:"noreferrer noopener",target:"_blank",className:"card-header-action"}),o.a.createElement("small",{className:"text-muted"},n||"docs")))}))},654:function(e,t,n){"use strict";function r(e,t){if(null==e)return{};var n,r,a=function(e,t){if(null==e)return{};var n,r,a={},o=Object.keys(e);for(r=0;r<o.length;r++)n=o[r],t.indexOf(n)>=0||(a[n]=e[n]);return a}(e,t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);for(r=0;r<o.length;r++)n=o[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(a[n]=e[n])}return a}n.d(t,"a",(function(){return r}))},663:function(e,t,n){"use strict";n.d(t,"a",(function(){return s}));var r=n(640),a=n.n(r),o=n(641),c=n(645),l=n(644),s=function(e){return function(){var t=Object(o.a)(a.a.mark((function t(n){var r,o;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(c.j)(e);case 2:r=t.sent,r=Object(l.b)(r),o=r.data.data.user.role_id,console.log(r.data.data.user.role_id,"hngbolo"),r.success&&1===o?(n({type:"LOGIN_SUCCESSFUL",payload:r.data}),localStorage.setItem("accessToken",r.data.data.access_token),localStorage.setItem("user",JSON.stringify(r.data)),localStorage.setItem("isLogin",!0)):(n({type:"LOGIN_FAILED",payload:r.error}),localStorage.clear());case 7:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()}},751:function(e,t,n){"use strict";n.r(t);var r=n(6),a=n(640),o=n.n(a),c=n(641),l=n(172),s=n(173),i=n(175),u=n(174),m=n(1),d=n.n(m),f=n(642),p=(n(653),n(171)),b=n(656),g=n.n(b),h=(n(651),n(22)),y=n(649),E=n(663),O=n(655),v=["first_name","email","phone","updated on","action"],j=function(e){Object(i.a)(n,e);var t=Object(u.a)(n);function n(){var e;Object(l.a)(this,n);for(var r=arguments.length,a=new Array(r),s=0;s<r;s++)a[s]=arguments[s];return(e=t.call.apply(t,[this].concat(a))).componentDidMount=Object(c.a)(o.a.mark((function t(){return o.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.props.get_user_list();case 2:case"end":return t.stop()}}),t)}))),e.confirmDialod=function(t){g.a.fire({title:"Are you sure?",text:"Are You Sure you want to delete this User!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(n){n.value&&e.props.delete_user(t)}))},e}return Object(s.a)(n,[{key:"render",value:function(){var e=this,t=this.props.user.user_list.users;return localStorage.getItem("accessToken")?d.a.createElement(d.a.Fragment,null,d.a.createElement(f.M,null,d.a.createElement(f.m,{xs:"12",lg:"12"},d.a.createElement(f.h,null,d.a.createElement(f.l,null,"All Users"),d.a.createElement(f.i,null,t?d.a.createElement(f.p,{items:t,fields:v,itemsPerPageSelect:!0,itemsPerPage:15,tableFilter:!0,pagination:!0,scopedSlots:{action:function(t){return d.a.createElement("tr",null,d.a.createElement("td",null,d.a.createElement(f.e,{type:"submit",size:"sm",onClick:function(n){return e.props.history.push("/viewuser/"+t.id)},color:"info"},"view")),d.a.createElement("td",null,d.a.createElement(f.e,{type:"submit",size:"sm",onClick:function(n){return e.props.history.push("/edituser/"+t.id)},color:"success"},"edit")),d.a.createElement("td",null," ",d.a.createElement(f.e,{type:"submit",size:"sm",color:"danger",onClick:function(n){return e.confirmDialod(t.id)}},"delete")))},"updated on":function(e){return d.a.createElement("td",null," ",O(e.updated_at).format("MMMM Do YYYY"))}}}):d.a.createElement("div",{className:"d-flex justify-content-center"},d.a.createElement("div",{className:"spinner-border",role:"status"},d.a.createElement("span",{className:"sr-only"},"Loading...")))))))):d.a.createElement(h.a,{from:"/",to:"/login"})}}]),n}(d.a.Component);t.default=Object(p.b)((function(e){return Object(r.a)({},e)}),{get_user_list:y.d,delete_user:y.a,do_login:E.a})(j)}}]);
//# sourceMappingURL=14.ace0fa62.chunk.js.map