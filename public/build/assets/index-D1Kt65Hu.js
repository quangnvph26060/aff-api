import{n as k,r as i,q as U,$,d as B,o,e as d,g as e,C as r,D as I,a1 as y,f as C,w as V,F as x,H as j,_ as q,a8 as D,R as M,U as N,u as R,E,x as b,v as w,h as F}from"./vendor-Dg8UqXFD.js";import{u as L}from"./useFormatCurrency-ovqMsPCw.js";import{a as A}from"./main-B7mYjJu2.js";import{P as G}from"./package-CxYAFr60.js";import{C as H}from"./cart-DMVufISf.js";import{_ as Q}from"./_plugin-vue_export-helper-DlAUqK2U.js";const n=c=>(M("data-v-1f93c5d2"),c=c(),N(),c),W={class:"row main_product_mobi"},z={class:"flex-gap"},J={class:"col-lg-3"},K={class:"col-lg-2"},O=n(()=>e("option",{value:""},"Danh Mục",-1)),X=n(()=>e("option",null,"Chọn 1",-1)),Y=[O,X],Z={class:"col-lg-2"},ee=n(()=>e("option",{value:""},"Phần trăm hoa hồng",-1)),te=n(()=>e("option",{value:"1"},"Tùy chọn 1",-1)),se=n(()=>e("option",{value:"2"},"Tùy chọn 2",-1)),ae=[ee,te,se],oe=n(()=>e("div",{class:"col-lg-2"},[e("button",{class:"btn btn-primary"},"Tìm kiếm")],-1)),ne=D('<div class="row mb-4 mt-4" data-v-1f93c5d2><div class="col-lg-6 col-md-12" data-v-1f93c5d2><img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2024/06/banner/1200x100-1200x100-1.jpg" class="img-fluid" alt="Banner" data-v-1f93c5d2></div><div class="col-lg-6 col-md-12" data-v-1f93c5d2><img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2024/06/banner/1200x100-1200x100-1.jpg" class="img-fluid h-img-mb" alt="Banner" data-v-1f93c5d2></div></div>',1),ce=["data-index"],le={class:"card shadow-sm"},ie={class:"main-img"},de={class:"card-body px-3 pt-3"},re={class:"text-xs font-thin text-slate-500 text-truncate"},me={class:"font-weight-bold product-name"},_e={class:"d-flex justify-content-between align-items-center"},pe={class:"color-secondary font-semibold"},ue=k({__name:"index",setup(c){const{responsePackage:m,getAllPackages:_}=G();H(),R();const S=E(),p=async l=>{await S.push(`/packages/detail/${l}`)},u=i([]);U(async()=>{await _(),u.value=m.data,document.querySelectorAll(".product-grid .product").forEach((s,a)=>{$.fromTo(s,{opacity:0,y:100},{opacity:1,y:0,duration:.5,delay:a*.1})})});const P=l=>{const s=A.URL,a=l.replace("public","storage");return`${s}/${a}`},g=i(""),v=i(""),f=i("");return(l,s)=>{const a=B("a-image");return o(),d(x,null,[e("div",W,[e("form",z,[e("div",J,[r(e("input",{type:"text",class:"form-control",placeholder:"Tìm kiếm...","onUpdate:modelValue":s[0]||(s[0]=t=>g.value=t)},null,512),[[I,g.value]])]),e("div",K,[r(e("select",{class:"form-control","onUpdate:modelValue":s[1]||(s[1]=t=>v.value=t)},Y,512),[[y,v.value]])]),e("div",Z,[r(e("select",{class:"form-control","onUpdate:modelValue":s[2]||(s[2]=t=>f.value=t)},ae,512),[[y,f.value]])]),oe]),ne]),C(q,{name:"fade",tag:"div",appear:"",class:"row row-cols-5 gy-4 d-flex flex_column_mobi"},{default:V(()=>[(o(!0),d(x,null,j(u.value,(t,h)=>(o(),d("div",{key:h,"data-index":h,class:"col-lg-2 col-12"},[e("div",le,[e("div",ie,[t&&t.image&&t.image.length>0?(o(),b(a,{key:0,src:P(t.image),preview:!1,class:"card-img-top object-fit-cover",onClick:T=>p(t.id),width:"100%"},null,8,["src","onClick"])):(o(),b(a,{key:1,src:"Capture.PNG",preview:!1,class:"card-img-top object-fit-cover",onClick:T=>p(t.id)},null,8,["onClick"]))]),e("div",de,[e("div",re,[e("span",me,w(t.name),1)]),e("div",_e,[e("span",pe,w(F(L)(t==null?void 0:t.price)),1)])])])],8,ce))),128))]),_:1})],64)}}}),ge=Q(ue,[["__scopeId","data-v-1f93c5d2"]]),we=k({__name:"index",setup(c){return(m,_)=>(o(),d("div",null,[C(ge)]))}});export{we as default};
