(this["webpackJsonp@coreui/coreui-free-react-admin-template"]=this["webpackJsonp@coreui/coreui-free-react-admin-template"]||[]).push([[25],{646:function(e,t,a){"use strict";a.d(t,"d",(function(){return s})),a.d(t,"e",(function(){return l})),a.d(t,"f",(function(){return u})),a.d(t,"c",(function(){return d})),a.d(t,"a",(function(){return p})),a.d(t,"b",(function(){return m}));var n=a(640),r=a.n(n),c=a(641),o=a(645),i=a(644),s=function(e){return function(){var t=Object(c.a)(r.a.mark((function t(a){var n;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(o.c)(e);case 2:n=t.sent,(n=Object(i.b)(n)).success?a({type:"CATEGORY_DATA",payload:n.data.data}):a({type:"ERROR_OCCURED",payload:n.error});case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()},l=function(e){return function(){var t=Object(c.a)(r.a.mark((function t(a){var n;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(o.o)(e);case 2:n=t.sent,(n=Object(i.b)(n)).success?a({type:"CATEGORY_DATA_ID",payload:n.data.data}):a({type:"ERROR_OCCURED",payload:n.error});case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()},u=function(e){return function(){var t=Object(c.a)(r.a.mark((function t(a){var n,c;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(o.p)(e);case 2:n=t.sent,(n=Object(i.b)(n)).success?(a({type:"SUBCATEGORY_DATA_ID",payload:n.data.data}),c=localStorage.setItem("a",n.data.status),console.log(c,"hih")):a({type:"ERROR_OCCURED",payload:n.error});case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()},d=function(e){return function(){var t=Object(c.a)(r.a.mark((function t(a){var n;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(o.l)(e);case 2:n=t.sent,(n=Object(i.b)(n)).success?a({type:"UPDATE_DATA_ID",payload:n.data}):a({type:"ERROR_OCCURED",payload:n.error});case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()},p=function(e){return function(){var t=Object(c.a)(r.a.mark((function t(a){var n;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(o.e)(e);case 2:n=t.sent,(n=Object(i.b)(n)).success?a({type:"CREATE_CATEGORY",payload:n}):a({type:"ERROR_OCCURED",payload:n.error});case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()},m=function(e){return function(){var t=Object(c.a)(r.a.mark((function t(a){var n;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(o.g)(e);case 2:n=t.sent,(n=Object(i.b)(n)).success?a(s()):a({type:"ERROR_OCCURED",payload:n.error});case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()}},748:function(e,t,a){"use strict";a.r(t);var n=a(640),r=a.n(n),c=a(641),o=a(177),i=a(6),s=a(172),l=a(173),u=a(176),d=a(175),p=a(174),m=a(1),f=a.n(m),y=a(642),h=a(643),b=a(646),g=a(171),E=a(656),v=a.n(E),O=(a(651),a(763)),_=["name","description","action"],w=function(e){Object(d.a)(a,e);var t=Object(p.a)(a);function a(e){var n;return Object(s.a)(this,a),(n=t.call(this,e)).confirmDialod=function(e){v.a.fire({title:"Are you sure?",text:"Are You Sure you want to delete this User!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(t){t.value&&n.props.delete_category(e)}))},n.formValidate=function(){for(var e=n.props.category.categoryid_list.category,t=!0,a=function(){var a=c[r];e[a]||(t=!1,n.setState((function(e){return{error:Object(i.a)(Object(i.a)({},e.error),{},Object(o.a)({},a,"Please fill in the above field"))}})))},r=0,c=["name","description"];r<c.length;r++)a();return t},n.onSelect=function(){var e=Object(c.a)(r.a.mark((function e(t){var a;return r.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:a=t.target.value,n.props.get_subcategory_data_byid(a);case 2:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),n.componentDidMount=Object(c.a)(r.a.mark((function e(){var t;return r.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,n.props.get_subcategory_data_byid(n.props.match.params.clientId);case 2:return e.next=4,n.props.get_category_data_byid(n.props.match.params.clientId);case 4:return t=n.props.category.categoryid_list.category,e.next=7,n.setState({data:t,id:n.props.match.params.clientId});case 7:case"end":return e.stop()}}),e)}))),n.state={info:"false",data:{},subcatdata:{},SubCategorydata:{},errors:{},showHide:!1,showMore:!1,popup:!1,datasubnew:{}},n.onSelect=n.onSelect.bind(Object(u.a)(n)),n.formValidate=n.formValidate.bind(Object(u.a)(n)),n.handleSubmit=n.handleSubmit.bind(Object(u.a)(n)),n}return Object(l.a)(a,[{key:"handleModalShowHide",value:function(e){this.props.get_category_data_byid(e),this.setState({showHide:!this.state.showHide}),this.setState({popup:!0})}},{key:"handleChange",value:function(e){e.preventDefault();var t=this.props.category.categoryid_list.category,a=e.target.name,n=e.target.value;t[a]=n,this.setState({SubCategorydata:t})}},{key:"handleSubmit",value:function(e){var t=this;e.preventDefault();var a=this.props.category.categoryid_list.category;if(this.formValidate()&&a){var n={id:a.id,name:a.name,description:a.description};this.props.edit_category(n).then(Object(c.a)(r.a.mark((function e(){return r.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:t.props.history.push("/allcategory"),t.setState({isLogin:!1});case 2:case"end":return e.stop()}}),e)})))).catch((function(e){console.log("err",e)}))}}},{key:"render",value:function(){var e=this,t=this.props.category.categoryid_list.category,a=this.props.category.subcategoryid_list.categories,n=this.state,r=n.data,c=n.errors,o=n.datasubnew;return console.log(o,"sfdfd"),f.a.createElement(f.a.Fragment,null,f.a.createElement(y.h,null,f.a.createElement(y.l,null,"Category View"),f.a.createElement(y.i,{style:{display:"grid"}},f.a.createElement("div",{style:{display:"inline-flex"}},f.a.createElement("h4",null,"Parent category : "),"  ",f.a.createElement("p",{style:{fontSize:"18px"}},r.name)),f.a.createElement("div",{style:{display:"inline-flex"}},f.a.createElement("h4",null,"Description : "),"  ",f.a.createElement("p",{style:{fontSize:"18px"}},r.description))),f.a.createElement(y.l,null,f.a.createElement("h2",null,"Subcategory view")),f.a.createElement(y.i,null,f.a.createElement(y.p,{items:a,fields:_,itemsPerPage:10,pagination:!0,scopedSlots:{action:function(t){return f.a.createElement("tr",null,f.a.createElement("td",null,"   ",f.a.createElement(y.e,{color:"info",onClick:function(){return e.handleModalShowHide(t.id)}},"Update ")),f.a.createElement("td",null," ",f.a.createElement(y.e,{type:"submit",size:"sm",onClick:function(a){return e.confirmDialod(t.id)},color:"danger"},"delete")))}}}),f.a.createElement(O.a,{show:this.state.showHide},f.a.createElement(O.a.Header,{className:"popupheader"},f.a.createElement(O.a.Title,null,"Update subcategory")),f.a.createElement(O.a.Body,{className:"popupbox"},f.a.createElement(y.i,null,f.a.createElement(y.w,{action:"",method:"post",encType:"multipart/form-data",className:"form-horizontal"},t?f.a.createElement(y.x,{row:!0},f.a.createElement(y.m,{md:"3"},f.a.createElement(y.I,{htmlFor:"select"},"Category Name")),f.a.createElement(y.m,{xs:"12",md:"9"},f.a.createElement(y.C,{name:"name",id:"name",onChange:this.handleChange.bind(this),value:t.name,invalid:!!c.name,placeholder:"Enter your category name"}),c.name?f.a.createElement(y.I,{className:"is-invalid text-danger"},c.name):"")):" ",t?f.a.createElement(y.x,{row:!0},f.a.createElement(y.m,{md:"3"},f.a.createElement(y.I,{htmlFor:"textarea-input"},"Textarea")),f.a.createElement(y.m,{xs:"12",md:"9"},f.a.createElement(y.X,{name:"description",id:"description",rows:"9",value:t.description,onChange:this.handleChange.bind(this),invalid:!!c.description,placeholder:"Content..."}),c.description?f.a.createElement(y.I,{className:"is-invalid text-danger"},c.description):"")):""))),f.a.createElement(O.a.Footer,{className:"footeralert"},f.a.createElement(y.j,null,f.a.createElement(y.e,{type:"submit",onClick:this.handleSubmit,size:"sm",color:"primary"},f.a.createElement(h.a,{name:"cil-scrubber"})," Submit"),f.a.createElement(y.e,{type:"reset",size:"sm",onClick:function(){return e.handleModalShowHide()},color:"danger"},f.a.createElement(h.a,{name:"cil-ban"})," cancel")))))))}}]),a}(f.a.Component);t.default=Object(g.b)((function(e){return Object(i.a)({},e)}),{get_subcategory_data_byid:b.f,delete_category:b.b,create_category:b.a,get_category_data:b.d,get_category_data_byid:b.e,edit_category:b.c})(w)}}]);
//# sourceMappingURL=25.250b0fa9.chunk.js.map