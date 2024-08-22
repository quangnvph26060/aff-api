import{n as H,q as U,r as h,d as c,o as r,e as g,g as t,h as s,x as C,z as M,v as l,f as i,C as V,D as $,w as d,B as T,F as D,I as P,G as K,H as N,E}from"./vendor-ZmbnWLp6.js";import{P as F}from"./product-BkSUp_uB.js";import{u as q}from"./useFormatCurrency-ovqMsPCw.js";import{C as R}from"./cart-TYIKaryu.js";import{a as z}from"./main-H3fHEa0S.js";/* empty css               */import{_ as G}from"./_plugin-vue_export-helper-DlAUqK2U.js";const _=p=>(K("data-v-062a6f59"),p=p(),N(),p),Z={class:"bg-[white] p-5 space-y-5 layout_mobi"},O={class:"row flex-warp d-flex"},A={class:"col-lg-6 col-12 flex justify-center main_img_product"},J={class:"col-lg-6 col-12 space-y-4"},Q={class:"text-2xl text-main"},W={class:"text-xl"},X={class:"text-base ml-3 line-through text-slate-400 main_commission"},Y=["innerHTML"],tt={class:"grid lg:grid-cols-12 gap-4 items-center"},et={class:"col-span-3 d-flex justify-content-start"},st=_(()=>t("span",null,"Số Lượng:",-1)),at={class:"w-20"},ot=["max"],nt={class:"grid grid-cols-6 gap-4 mt-3 buy_cart"},it=["innerHTML"],lt=_(()=>t("form",null,[t("div",{class:"form-group"},[t("label",{for:"description"},"Mô tả"),t("textarea",{class:"form-control",id:"description",name:"description",rows:"3",required:""})]),t("div",{class:"form-group"},[t("label",{for:"name"},"Tên của bạn"),t("input",{type:"text",class:"form-control",id:"name",name:"name",required:""})]),t("div",{class:"form-group"},[t("label",{for:"email"},"Email của bạn"),t("input",{type:"email",class:"form-control",id:"email",name:"email",required:""})]),t("div",{class:"form-group"},[t("label",{for:"phone"},"Số điện thoại"),t("input",{type:"tel",class:"form-control",id:"phone",name:"phone",required:""})]),t("div",{class:"form-group"},[t("label",{for:"rating"},"Đánh giá (số sao)"),t("input",{type:"number",class:"form-control",id:"rating",name:"rating",min:"1",max:"5",required:""})]),t("button",{type:"submit",class:"btn btn-primary"},"Gửi đánh giá")],-1)),ct={class:"mb-10"},rt=_(()=>t("div",{class:"text-center"},[t("span",{class:"text-[18px] font-semibold-product"},"Sản phẩm tương tự ")],-1)),dt={class:"scrollbar-flex-content space-x-4 my-4"},pt={class:"row d-flex gap-4 main_sanpham"},mt=["onClick"],_t={class:"space-y-2"},ut={class:"relative",style:{position:"relative",display:"inline-block",width:"100%"}},ht={class:"h-7 main_commission w-[40px] md:w-[60px] icon-center justify-center absolute top-[5px] right-[5px] bg-gradient-to-r from-rose-500 to-fuchsia-500 rounded-md text-center text-white text-sm",style:{"box-shadow":"0 4px 6px rgba(0, 0, 0, 0.1)",position:"absolute",right:"10px"}},gt={class:"px-3 space-y-3"},ft={class:"text-start"},xt={class:"line-clamp-2",style:{overflow:"hidden","text-overflow":"ellipsis",display:"-webkit-box","-webkit-line-clamp":"2","-webkit-box-orient":"vertical"}},vt={class:"d-flex justify-content-between align-items-center"},bt={class:"text-secondary font-bold"},yt=["onClick"],wt=_(()=>t("svg",{xmlns:"http://www.w3.org/2000/svg",width:"20",height:"20",viewBox:"0 0 24 24"},[t("path",{fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"1.5",d:"M3 3c.83.305 1.968.542 2.48 1.323c.356.545.356 1.268.356 2.715V9.76c0 2.942.061 3.912.892 4.826c.83.914 2.168.914 4.842.914h5.085c2.666 0 3.244-.601 3.756-3.193c.224-1.13.45-2.246.564-3.373c.216-2.134-.973-2.814-2.866-2.814H5.836M16.5 21a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Zm-8 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Z"})],-1)),kt=[wt],Ct=H({__name:"Detail",setup(p){const I=E(),{responseProduct:a,findProduct:f}=F(),{addToCart:L}=R();U(async()=>{const o=window.location.href,n=o.substring(o.lastIndexOf("/")+1);await f(n)}),h(null);const x=h(1);function v(o){L(o)}const b=h("1"),y=o=>{const n=z.URL,m=o.replace("public","storage");return`${n}/${m}`},S=async o=>{f(o),await I.push(`/affilate/products/detail/${o}`)};return(o,n)=>{const m=c("a-image"),u=c("a-divider"),w=c("a-button"),k=c("a-tab-pane"),j=c("a-tabs");return r(),g("div",Z,[t("div",O,[t("div",A,[s(a).data&&s(a).data.images&&s(a).data.images.length>0?(r(),C(m,{key:0,src:y(s(a).data.images[0].image_path),class:"object-cover max-w-[500px]",preview:!1},null,8,["src"])):M("",!0)]),t("div",J,[t("span",Q,l(s(a).data.name),1),t("p",null,[t("span",W,l(s(q)(s(a).data.price)),1),t("span",X,l(s(a).data.commission_rate)+" % ",1)]),i(u),t("div",{innerHTML:s(a).data.description},null,8,Y),i(u),t("div",tt,[t("div",et,[st,t("span",at,[V(t("input",{type:"number","onUpdate:modelValue":n[0]||(n[0]=e=>x.value=e),min:1,max:s(a).data.quantity,size:"10",class:"w-full"},null,8,ot),[[$,x.value]])])])]),t("div",nt,[i(w,{type:"primary",class:"h-[40px] col-span-3 lg:col-span-2 bg-secondary",style:{"margin-right":"10px"}},{default:d(()=>[T(" Mua ngay ")]),_:1}),i(w,{class:"h-[40px] color-secondary col-span-3 lg:col-span-2",onClick:n[1]||(n[1]=e=>v(s(a).data.id))},{default:d(()=>[T(" Thêm vào giỏ ")]),_:1})])])]),t("div",null,[i(j,{activeKey:b.value,"onUpdate:activeKey":n[2]||(n[2]=e=>b.value=e),class:"xl:px-5"},{default:d(()=>[i(k,{key:"1",tab:"Chi tiết sản phẩm"},{default:d(()=>[t("div",{innerHTML:s(a).data.description},null,8,it)]),_:1}),i(k,{key:"2",tab:"Đánh giá"},{default:d(()=>[lt]),_:1})]),_:1},8,["activeKey"])]),i(u),t("div",ct,[rt,t("div",dt,[t("div",pt,[(r(!0),g(D,null,P(s(a).productCategory,e=>(r(),g("div",{key:e.index,class:"shadow-xl transition duration-300 rounded-[10px] hover:shadow-2xl cursor-pointer pb-3 scrollbar-demo-item main-img",onClick:B=>S(e.id)},[t("div",_t,[t("div",ut,[e&&e.images&&e.images.length>0?(r(),C(m,{key:0,src:y(e.images[0].image_path),preview:!1,class:"object-fill h-[150px] lg:h-[200px]"},null,8,["src"])):M("",!0),t("div",ht,l(e.commission_rate)+"% ",1)]),t("div",gt,[t("div",ft,[t("p",xt,l(e.name),1)]),t("div",vt,[t("span",bt,l(s(q)(e.price)),1),t("span",{class:"font-thin text-xs line-through click-hover",onClick:B=>v(e.id)},kt,8,yt)])])])],8,mt))),128))])])])])}}}),Bt=G(Ct,[["__scopeId","data-v-062a6f59"]]);export{Bt as default};
