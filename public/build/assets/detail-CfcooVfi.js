import{P as N}from"./package-fTHgwyVo.js";import{u as V}from"./useFormatCurrency-ovqMsPCw.js";import{n as K,r as s,q as O,d as i,o as _,e as I,g as e,x as T,z as E,v as b,h as R,f as l,w as c,B as y,u as D,P as j,Q as z,E as A}from"./vendor-BYqNKCR2.js";import{a as F}from"./main-B_y2_4ec.js";/* empty css               */import{_ as G}from"./_plugin-vue_export-helper-DlAUqK2U.js";const Q=d=>(j("data-v-ef1c904b"),d=d(),z(),d),$={class:"bg-[white] p-5 space-y-5 layout_mobi"},J={class:"row flex-warp d-flex"},W={class:"col-lg-6 col-12 flex justify-center main_img_product"},X={class:"col-lg-6 col-12 space-y-4"},Y={class:"text-2xl"},Z={class:"text-xl"},ee=["innerHTML"],ae={class:"grid grid-cols-6 gap-4 mt-3 buy_cart"},te={class:"modal-content"},oe=["src"],se={class:"modal-title"},ne={class:"font-weight-bold"},le={key:1},re=["innerHTML"],ie=Q(()=>e("form",null,[e("div",{class:"form-group"},[e("label",{for:"description"},"Mô tả"),e("textarea",{class:"form-control",id:"description",name:"description",rows:"3",required:""})]),e("div",{class:"form-group"},[e("label",{for:"name"},"Tên của bạn"),e("input",{type:"text",class:"form-control",id:"name",name:"name",required:""})]),e("div",{class:"form-group"},[e("label",{for:"email"},"Email của bạn"),e("input",{type:"email",class:"form-control",id:"email",name:"email",required:""})]),e("div",{class:"form-group"},[e("label",{for:"phone"},"Số điện thoại"),e("input",{type:"tel",class:"form-control",id:"phone",name:"phone",required:""})]),e("div",{class:"form-group"},[e("label",{for:"rating"},"Đánh giá (số sao)"),e("input",{type:"number",class:"form-control",id:"rating",name:"rating",min:"1",max:"5",required:""})]),e("button",{type:"submit",class:"btn btn-primary"},"Gửi đánh giá")],-1)),ce=K({__name:"detail",setup(d){A();const{findPackage:U,responsePackage:x,submitOrder:B}=N(),k=D(),n=s([]),u=s(""),w=s("");O(async()=>{const t=window.location.href,a=t.substring(t.lastIndexOf("/")+1);w.value=a,await U(a),n.value=x.data;const r=await k.getters.user,o=await k.getters.admin;u.value=r,o&&o.user_info&&o.user_info.length>0&&(M.value=o.user_info[0].branch)}),s(null),s(1);const M=s(""),v=s(""),C=s("1"),P=t=>{const a=F.URL,r=t.replace("public","storage");return`${a}/${r}`},p=s(!1),S=()=>{p.value=!0;for(var t="",a="ABCDEFGHIJKLMNOPQRSTUVWXYZ",r=a.length,o=0;o<8;o++){var m=Math.floor(Math.random()*r),g=a.charAt(m);t+=g}v.value=t},f=s(!1),q=async()=>{f.value=!0;const t={name:u.value.name,receive_address:u.value.address,phone:u.value.phone,package_id:w.value,zip_code:v.value,total_money:x.data.price};console.log(t);try{await B(t),p.value=!1}catch{}finally{f.value=!1}};return(t,a)=>{const r=i("a-image"),o=i("a-divider"),m=i("a-button"),g=i("a-modal"),L=i("a-tab-pane"),H=i("a-tabs");return _(),I("div",$,[e("div",J,[e("div",W,[n.value&&n.value.image&&n.value.image.length>0?(_(),T(r,{key:0,src:P(n.value.image),class:"object-cover max-w-[500px]",preview:!1},null,8,["src"])):E("",!0)]),e("div",X,[e("span",Y,b(n.value.name),1),e("p",null,[e("span",Z,b(R(V)(n.value.price)),1)]),l(o),e("div",{innerHTML:n.value.note},null,8,ee),l(o),e("div",ae,[l(m,{type:"primary",class:"h-[40px] col-span-3 lg:col-span-2 bg-secondary",style:{"margin-right":"10px"},onClick:S},{default:c(()=>[y(" Mua ngay ")]),_:1}),l(g,{visible:p.value,"onUpdate:visible":a[0]||(a[0]=h=>p.value=h),title:"Thanh toán",footer:null},{default:c(()=>[e("div",te,[e("img",{src:M.value,alt:"Hình ảnh",style:{width:"80%"}},null,8,oe),e("p",se,[y(" Nội dung chuyển khoản: "),e("span",ne,b(v.value),1)]),f.value!=!0?(_(),T(m,{key:0,type:"primary",class:"bg-secondary",onClick:q},{default:c(()=>[y("Mua")]),_:1})):(_(),I("p",le,"Loading..."))])]),_:1},8,["visible"])])])]),e("div",null,[l(H,{activeKey:C.value,"onUpdate:activeKey":a[1]||(a[1]=h=>C.value=h),class:"xl:px-5"},{default:c(()=>[l(L,{key:"1",tab:"Chi tiết sản phẩm"},{default:c(()=>[e("div",{innerHTML:n.value.note},null,8,re)]),_:1}),l(L,{key:"2",tab:"Đánh giá"},{default:c(()=>[ie]),_:1})]),_:1},8,["activeKey"])]),l(o)])}}}),fe=G(ce,[["__scopeId","data-v-ef1c904b"]]);export{fe as default};
