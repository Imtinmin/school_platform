webpackJsonp([8],{275:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r(316),n=r(389),o=r(65),i=o(a.a,n.a,!1,null,null,null);t.default=i.exports},299:function(e,t,r){"use strict";var a=r(39),n=r.n(a),o=r(38),i=r.n(o),s=r(40),u=r.n(s),l=r(116),c=r.n(l),p=r(41),d=r.n(p),h=r(42),m=r.n(h),f=r(118),v=r.n(f),_=r(117),b=r.n(_),C=r(115),k=function(e){function t(){return d()(this,t),v()(this,(t.__proto__||c()(t)).apply(this,arguments))}return b()(t,e),m()(t,[{key:"getCourseList",value:function(){var e=this;return new u.a(function(){var t=i()(n.a.mark(function t(r,a){var o;return n.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,e.request("GET","/CourseCategory/CourseList",null,{needAuth:!0});case 3:o=t.sent,r(o),t.next=10;break;case 7:t.prev=7,t.t0=t.catch(0),a(t.t0);case 10:case"end":return t.stop()}},t,e,[[0,7]])}));return function(e,r){return t.apply(this,arguments)}}())}},{key:"getCourseInfo",value:function(e){var t=this;return new u.a(function(){var r=i()(n.a.mark(function r(a,o){var i;return n.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return r.prev=0,r.next=3,t.request("GET","/course/CourseInfo",{course_id:e},{needAuth:!0});case 3:i=r.sent,a(i),r.next=10;break;case 7:r.prev=7,r.t0=r.catch(0),o(r.t0);case 10:case"end":return r.stop()}},r,t,[[0,7]])}));return function(e,t){return r.apply(this,arguments)}}())}},{key:"AdminCourseList",value:function(){var e=this;return new u.a(function(){var t=i()(n.a.mark(function t(r,a){var o;return n.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,e.request("GET","/CourseCategory/AllCourseList",null,{needAuth:!0});case 3:o=t.sent,r(o),t.next=10;break;case 7:t.prev=7,t.t0=t.catch(0),a(t.t0);case 10:case"end":return t.stop()}},t,e,[[0,7]])}));return function(e,r){return t.apply(this,arguments)}}())}},{key:"DeleteCourse",value:function(e){var t=this;return new u.a(function(){var r=i()(n.a.mark(function r(a,o){var i;return n.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return r.prev=0,r.next=3,t.request("POST","/course/DelCourse",{course_id:e},{needAuth:!0});case 3:i=r.sent,a(i),r.next=10;break;case 7:r.prev=7,r.t0=r.catch(0),o(r.t0);case 10:case"end":return r.stop()}},r,t,[[0,7]])}));return function(e,t){return r.apply(this,arguments)}}())}},{key:"UpdateCourse",value:function(e,t,r,a,o){var s=this;return new u.a(function(){var u=i()(n.a.mark(function i(u,l){var c;return n.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,s.request("POST","/course/UpdateCourse",{course_id:e,courseName:t,course_category_id:r,image_url:a,Introduction:o},{needAuth:!0});case 3:c=n.sent,u(c),n.next=10;break;case 7:n.prev=7,n.t0=n.catch(0),l(n.t0);case 10:case"end":return n.stop()}},i,s,[[0,7]])}));return function(e,t){return u.apply(this,arguments)}}())}},{key:"AddCouse",value:function(e,t,r,a){var o=this;return new u.a(function(){var s=i()(n.a.mark(function i(s,u){var l;return n.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,o.request("POST","/course/AddCourse",{courseName:e,course_category_id:r,image_url:t,Introduction:a},{needAuth:!0});case 3:l=n.sent,s(l),n.next=10;break;case 7:n.prev=7,n.t0=n.catch(0),u(n.t0);case 10:case"end":return n.stop()}},i,o,[[0,7]])}));return function(e,t){return s.apply(this,arguments)}}())}}]),t}(C.a);t.a=new k},301:function(e,t,r){"use strict";var a=r(39),n=r.n(a),o=r(38),i=r.n(o),s=r(40),u=r.n(s),l=r(116),c=r.n(l),p=r(41),d=r.n(p),h=r(42),m=r.n(h),f=r(118),v=r.n(f),_=r(117),b=r.n(_),C=r(115),k=function(e){function t(){return d()(this,t),v()(this,(t.__proto__||c()(t)).apply(this,arguments))}return b()(t,e),m()(t,[{key:"getChapterList",value:function(e){var t=this;return new u.a(function(){var e=i()(n.a.mark(function e(r,a){var o;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.request("GET","/course/CourseList");case 3:o=e.sent,r(o),e.next=10;break;case 7:e.prev=7,e.t0=e.catch(0),a(e.t0);case 10:case"end":return e.stop()}},e,t,[[0,7]])}));return function(t,r){return e.apply(this,arguments)}}())}},{key:"addChapter",value:function(e,t,r){var a=this;return new u.a(function(){var o=i()(n.a.mark(function o(i,s){var u;return n.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,a.request("POST","/chapter/addChapter",{chapterName:e,course_id:t,order_num:r});case 3:u=n.sent,i(u),n.next=10;break;case 7:n.prev=7,n.t0=n.catch(0),s(n.t0);case 10:case"end":return n.stop()}},o,a,[[0,7]])}));return function(e,t){return o.apply(this,arguments)}}())}},{key:"DelChapter",value:function(e){var t=this;return new u.a(function(){var r=i()(n.a.mark(function r(a,o){var i;return n.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return r.prev=0,r.next=3,t.request("POST","/chapter/delChapter",{chapter_id:e});case 3:i=r.sent,a(i),r.next=10;break;case 7:r.prev=7,r.t0=r.catch(0),o(r.t0);case 10:case"end":return r.stop()}},r,t,[[0,7]])}));return function(e,t){return r.apply(this,arguments)}}())}},{key:"UpdateChapter",value:function(e,t,r){var a=this;return new u.a(function(){var o=i()(n.a.mark(function o(i,s){var u;return n.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,a.request("POST","/chapter/UpdateChapter",{chapter_id:e,chapterName:t,order_num:r});case 3:u=n.sent,i(u),n.next=10;break;case 7:n.prev=7,n.t0=n.catch(0),s(n.t0);case 10:case"end":return n.stop()}},o,a,[[0,7]])}));return function(e,t){return o.apply(this,arguments)}}())}}]),t}(C.a);t.a=new k},307:function(e,t,r){"use strict";var a=r(39),n=r.n(a),o=r(38),i=r.n(o),s=r(40),u=r.n(s),l=r(116),c=r.n(l),p=r(41),d=r.n(p),h=r(42),m=r.n(h),f=r(118),v=r.n(f),_=r(117),b=r.n(_),C=r(115),k=function(e){function t(){return d()(this,t),v()(this,(t.__proto__||c()(t)).apply(this,arguments))}return b()(t,e),m()(t,[{key:"DeleteVideo",value:function(e){var t=this;return new u.a(function(){var r=i()(n.a.mark(function r(a,o){var i;return n.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return r.prev=0,r.next=3,t.request("POST","/video/DelVideo",{video_id:e});case 3:i=r.sent,a(i),r.next=10;break;case 7:r.prev=7,r.t0=r.catch(0),o(r.t0);case 10:case"end":return r.stop()}},r,t,[[0,7]])}));return function(e,t){return r.apply(this,arguments)}}())}},{key:"EditVideo",value:function(e,t,r,a,o,s){var l=this;return new u.a(function(){var u=i()(n.a.mark(function i(u,c){var p;return n.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,l.request("POST","/video/EditVideo",{video_id:e,title:t,content:r,url:a,order_num:o,ppt_url:s});case 3:p=n.sent,u(p),n.next=10;break;case 7:n.prev=7,n.t0=n.catch(0),c(n.t0);case 10:case"end":return n.stop()}},i,l,[[0,7]])}));return function(e,t){return u.apply(this,arguments)}}())}},{key:"AddVideo",value:function(e,t,r,a,o,s){var l=this;return new u.a(function(){var u=i()(n.a.mark(function i(u,c){var p;return n.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,l.request("POST","/video/AddVideo",{title:e,content:t,chapter_id:r,url:o,order_num:a,ppt_url:s});case 3:p=n.sent,u(p),n.next=10;break;case 7:n.prev=7,n.t0=n.catch(0),c(n.t0);case 10:case"end":return n.stop()}},i,l,[[0,7]])}));return function(e,t){return u.apply(this,arguments)}}())}}]),t}(C.a);t.a=new k},316:function(e,t,r){"use strict";var a=r(39),n=r.n(a),o=r(38),i=r.n(o),s=r(299),u=r(301),l=r(307);t.a={data:function(){return{loading:!1,activeTab:"",result:[],chapter:[],CourseForm:{course_name:"",Introduction:"",url:"",category_id:"",course_id:""},ChapterForm:{chapter_id:"",chapter_name:"",order_num:""},VideoForm:{video_id:"",title:"",content:"",order_num:"",url:"",ppt_url:""},dialogCourseFormVisible:!1,dialogChapterFormVisible:!1,dialogVideoFormVisible:!1,formLabelWidth:"80px",labelPosition:"right",multipleSelection:[]}},methods:{LoadCourseList:function(){function e(){return t.apply(this,arguments)}var t=i()(n.a.mark(function e(){var t;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return this.loading=!0,e.prev=1,e.next=4,s.a.AdminCourseList();case 4:t=e.sent,this.result=t.data.data,this.chapter=t.data.data[0].course[0].chapter,this.activeTab=this.result[0].category_name,this.loading=!1,e.next=14;break;case 11:e.prev=11,e.t0=e.catch(1),this.$handleError(e.t0);case 14:case"end":return e.stop()}},e,this,[[1,11]])}));return e}(),reload:function(){this.$router.go(0)},handleClick:function(e,t){console.log(e,t)},handleSelectionChange:function(e){this.multipleSelection=e},UpdateCourse:function(){function e(e){return t.apply(this,arguments)}var t=i()(n.a.mark(function e(t){var r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,s.a.UpdateCourse(t,this.CourseForm.course_name,this.CourseForm.category_id,this.CourseForm.url,this.CourseForm.Introduction);case 3:r=e.sent,this.LoadCourseList(),this.$message.success("更改成功"),this.dialogCourseFormVisible=!1,e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),this.$handleError(e.t0);case 12:case"end":return e.stop()}},e,this,[[0,9]])}));return e}(),EditCourse:function(e,t){t=t[e],this.dialogCourseFormVisible=!0,this.CourseForm.course_id=t.course_id,this.CourseForm.url=t.image_url,this.CourseForm.course_name=t.course_name,this.CourseForm.Introduction=t.Introduction,this.CourseForm.category_id=t.course_category_id},DelCourse:function(){function e(e,r){return t.apply(this,arguments)}var t=i()(n.a.mark(function e(t,r){var a,o;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return a=r[t].course_id,e.prev=1,e.next=4,s.a.DeleteCourse(a);case 4:o=e.sent,this.$message.success("删除成功"),r.splice(t,1),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(1),this.$$handleError(e.t0);case 12:case"end":return e.stop()}},e,this,[[1,9]])}));return e}(),EditChapter:function(e,t){this.dialogChapterFormVisible=!0,this.ChapterForm.chapter_name=t.chapter_name,this.ChapterForm.order_num=t.order_num,this.ChapterForm.chapter_id=t.chapter_id},UpdateChapter:function(){function e(){return t.apply(this,arguments)}var t=i()(n.a.mark(function e(){var t;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,u.a.UpdateChapter(this.ChapterForm.chapter_id,this.ChapterForm.chapter_name,this.ChapterForm.order_num);case 3:t=e.sent,this.$message.success("修改成功"),this.LoadCourseList(),this.dialogChapterFormVisible=!1,e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),this.$handleError(e.t0);case 12:case"end":return e.stop()}},e,this,[[0,9]])}));return e}(),DelChapter:function(){function e(e,r){return t.apply(this,arguments)}var t=i()(n.a.mark(function e(t,r){var a,o;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return a=r.chapter_id,e.prev=1,e.next=4,u.a.DelChapter(a);case 4:o=e.sent,this.LoadCourseList(),this.$message.success("删除成功"),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(1),this.$handleError(e.t0);case 12:case"end":return e.stop()}},e,this,[[1,9]])}));return e}(),EditVideo:function(e,t){this.dialogVideoFormVisible=!0,this.VideoForm.video_id=t.video_id,this.VideoForm.title=t.title,this.VideoForm.content=t.content,this.VideoForm.order_num=t.order_num,this.VideoForm.url=t.url,this.VideoForm.ppt_url=t.ppt_url},UpdateVideo:function(){function e(e){return t.apply(this,arguments)}var t=i()(n.a.mark(function e(t){var r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,l.a.EditVideo(t,this.VideoForm.title,this.VideoForm.content,this.VideoForm.url,this.VideoForm.order_num,this.VideoForm.ppt_url);case 3:r=e.sent,this.LoadCourseList(),this.$message.success("编辑成功"),this.dialogVideoFormVisible=!1,e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),this.$handleError(e.t0);case 12:case"end":return e.stop()}},e,this,[[0,9]])}));return e}(),DelVideo:function(){function e(e,r){return t.apply(this,arguments)}var t=i()(n.a.mark(function e(t,r){var a,o;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return a=r.video_id,e.prev=1,e.next=4,l.a.DeleteVideo(a);case 4:o=e.sent,this.LoadCourseList(),this.$message.success("删除成功"),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(1),this.$handleError(e.t0);case 12:case"end":return e.stop()}},e,this,[[1,9]])}));return e}()},mounted:function(){this.LoadCourseList()}}},389:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-card",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}]},[r("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[r("span",[e._v("课程列表")]),e._v(" "),r("el-button",{attrs:{type:"primary",size:"small"},on:{click:function(t){return e.reload()}}},[e._v("刷新")])],1),e._v(" "),r("el-alert",{attrs:{title:"课程删除可能会延迟一下，更新数据刷新一下页面",type:"warning",effect:"dark"}}),e._v(" "),r("el-tabs",{on:{"tab-click":e.handleClick},model:{value:e.activeTab,callback:function(t){e.activeTab=t},expression:"activeTab"}},[e._l(e.result,function(t,a){return[r("el-tab-pane",{key:a,attrs:{label:t.category_name,name:t.category_name}},[r("el-table",{staticStyle:{width:"100%","margin-bottom":"20px"},attrs:{stripe:"",data:t.course,"row-key":"course_name"}},[r("el-table-column",{attrs:{type:"expand"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-table",{attrs:{data:t.row.chapter},on:{"selection-change":e.handleSelectionChange}},[r("el-table-column",{attrs:{type:"expand"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-table",{attrs:{data:t.row.video}},[r("el-table-column",{attrs:{label:"视频ID",prop:"video_id",width:"100"}}),e._v(" "),r("el-table-column",{attrs:{label:"视频链接",prop:"url"}}),e._v(" "),r("el-table-column",{attrs:{label:"视频说明",prop:"content"}}),e._v(" "),r("el-table-column",{attrs:{label:"序号",prop:"order_num",width:"100"}}),e._v(" "),r("el-table-column",{attrs:{label:"ppt链接",prop:"ppt_url"}}),e._v(" "),r("el-table-column",{attrs:{label:"添加时间",prop:"created_at"}}),e._v(" "),r("el-table-column",{attrs:{prop:"updated_at",label:"最新操作时间"}}),e._v(" "),r("el-table-column",{attrs:{label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-button",{attrs:{size:"mini"},on:{click:function(r){return e.EditVideo(t.$index,t.row)}}},[e._v("编辑\n                                                        ")]),e._v(" "),r("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(r){return e.DelVideo(t.$index,t.row)}}},[e._v("\n                                                            删除")])]}}],null,!0)})],1)]}}],null,!0)}),e._v(" "),r("el-table-column",{attrs:{prop:"chapter_id",label:"章节ID",width:"100"}}),e._v(" "),r("el-table-column",{attrs:{prop:"chapter_name",label:"章节名",width:"180"}}),e._v(" "),r("el-table-column",{attrs:{prop:"order_num",label:"序号",width:"100"}}),e._v(" "),r("el-table-column",{attrs:{prop:"created_at",label:"创建时间"}}),e._v(" "),r("el-table-column",{attrs:{prop:"updated_at",label:"最新操作时间"}}),e._v(" "),r("el-table-column",{attrs:{label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-button",{attrs:{size:"mini"},on:{click:function(r){return e.EditChapter(t.$index,t.row)}}},[e._v("编辑\n                                            ")]),e._v(" "),r("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(r){return e.DelChapter(t.$index,t.row)}}},[e._v("\n                                                删除")])]}}],null,!0)})],1)]}}],null,!0)}),e._v(" "),r("el-table-column",{attrs:{prop:"course_id",label:"课程ID",width:"100"}}),e._v(" "),r("el-table-column",{attrs:{prop:"course_name",label:"课程名",width:"180"}}),e._v(" "),r("el-table-column",{attrs:{prop:"image_url",label:"展示图片url"}}),e._v(" "),r("el-table-column",{attrs:{prop:"Introduction",label:"介绍"}}),e._v(" "),r("el-table-column",{attrs:{prop:"created_at",label:"创建时间"}}),e._v(" "),r("el-table-column",{attrs:{prop:"updated_at",label:"修改时间"}}),e._v(" "),r("el-table-column",{attrs:{label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-button",{attrs:{size:"mini"},on:{click:function(r){return e.EditCourse(t.$index,e.result[a].course)}}},[e._v("编辑\n                                ")]),e._v(" "),r("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(r){return e.DelCourse(t.$index,e.result[a].course)}}},[e._v("\n                                    删除")])]}}],null,!0)})],1)],1)]})],2)],1),e._v(" "),r("el-dialog",{attrs:{title:"编辑课程",width:"40%",visible:e.dialogCourseFormVisible},on:{"update:visible":function(t){e.dialogCourseFormVisible=t}}},[r("el-form",{attrs:{"label-position":e.labelPosition,model:e.CourseForm}},[r("el-form-item",{attrs:{label:"课程名称","label-width":e.formLabelWidth}},[r("el-input",{attrs:{autocomplete:"off"},model:{value:e.CourseForm.course_name,callback:function(t){e.$set(e.CourseForm,"course_name",t)},expression:"CourseForm.course_name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"图片url","label-width":e.formLabelWidth}},[r("el-input",{attrs:{autocomplete:"off"},model:{value:e.CourseForm.url,callback:function(t){e.$set(e.CourseForm,"url",t)},expression:"CourseForm.url"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"课程类型","label-width":e.formLabelWidth}},[r("el-select",{attrs:{placeholder:"请选择"},model:{value:e.CourseForm.category_id,callback:function(t){e.$set(e.CourseForm,"category_id",t)},expression:"CourseForm.category_id"}},e._l(e.result,function(t){return r("el-option",{key:t.category_id,attrs:{label:t.category_name,value:t.course_category_id}},[r("span",{staticStyle:{float:"left"}},[e._v(e._s(t.course_category_id))])])}),1)],1),e._v(" "),r("el-form-item",{attrs:{label:"介绍","label-width":e.formLabelWidth}},[r("el-input",{attrs:{type:"textarea",autocomplete:"off"},model:{value:e.CourseForm.Introduction,callback:function(t){e.$set(e.CourseForm,"Introduction",t)},expression:"CourseForm.Introduction"}})],1)],1),e._v(" "),r("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[r("el-button",{on:{click:function(t){e.dialogCourseFormVisible=!1}}},[e._v("取 消")]),e._v(" "),r("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.UpdateCourse(e.CourseForm.course_id)}}},[e._v("确 定")])],1)],1),e._v(" "),r("el-dialog",{attrs:{title:"编辑章节",width:"30%",visible:e.dialogChapterFormVisible},on:{"update:visible":function(t){e.dialogChapterFormVisible=t}}},[r("el-form",{attrs:{"label-position":e.labelPosition,model:e.ChapterForm}},[r("el-form-item",{attrs:{label:"章节名称","label-width":e.formLabelWidth}},[r("el-input",{attrs:{autocomplete:"off"},model:{value:e.ChapterForm.chapter_name,callback:function(t){e.$set(e.ChapterForm,"chapter_name",t)},expression:"ChapterForm.chapter_name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"序号","label-width":e.formLabelWidth}},[r("el-select",{attrs:{placeholder:"请选择"},model:{value:e.ChapterForm.order_num,callback:function(t){e.$set(e.ChapterForm,"order_num",t)},expression:"ChapterForm.order_num"}},e._l(6,function(e){return r("el-option",{key:e,attrs:{label:e,value:e}})}),1)],1)],1),e._v(" "),r("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[r("el-button",{on:{click:function(t){e.dialogChapterFormVisible=!1}}},[e._v("取 消")]),e._v(" "),r("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.UpdateChapter(e.ChapterForm.chapter_id)}}},[e._v("确 定")])],1)],1),e._v(" "),r("el-dialog",{attrs:{title:"编辑小节",width:"30%",visible:e.dialogVideoFormVisible},on:{"update:visible":function(t){e.dialogVideoFormVisible=t}}},[r("el-form",{attrs:{"label-position":e.labelPosition,model:e.ChapterForm}},[r("el-form-item",{attrs:{label:"小节名称","label-width":e.formLabelWidth}},[r("el-input",{attrs:{autocomplete:"off"},model:{value:e.VideoForm.title,callback:function(t){e.$set(e.VideoForm,"title",t)},expression:"VideoForm.title"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"序号","label-width":e.formLabelWidth}},[r("el-select",{attrs:{placeholder:"请选择"},model:{value:e.VideoForm.order_num,callback:function(t){e.$set(e.VideoForm,"order_num",t)},expression:"VideoForm.order_num"}},e._l(6,function(e){return r("el-option",{key:e,attrs:{label:e,value:e}})}),1)],1),e._v(" "),r("el-form-item",{attrs:{label:"视频链接","label-width":e.formLabelWidth}},[r("el-input",{attrs:{autocomplete:"off"},model:{value:e.VideoForm.url,callback:function(t){e.$set(e.VideoForm,"url",t)},expression:"VideoForm.url"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"PPT链接","label-width":e.formLabelWidth}},[r("el-input",{attrs:{autocomplete:"off"},model:{value:e.VideoForm.ppt_url,callback:function(t){e.$set(e.VideoForm,"ppt_url",t)},expression:"VideoForm.ppt_url"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"视频介绍","label-width":e.formLabelWidth}},[r("el-input",{attrs:{autocomplete:"off"},model:{value:e.VideoForm.content,callback:function(t){e.$set(e.VideoForm,"content",t)},expression:"VideoForm.content"}})],1)],1),e._v(" "),r("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[r("el-button",{on:{click:function(t){e.dialogChapterFormVisible=!1}}},[e._v("取 消")]),e._v(" "),r("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.UpdateVideo(e.VideoForm.video_id)}}},[e._v("确 定")])],1)],1)],1)},n=[],o={render:a,staticRenderFns:n};t.a=o}});
//# sourceMappingURL=8.js.map?9fbf7f5cd8d1ccfc3675