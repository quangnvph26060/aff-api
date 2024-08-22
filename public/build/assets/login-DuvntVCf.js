import{n as j,p as k,r as v,q as E,d as h,o as r,e as c,g as o,v as p,x as C,w as d,f as t,h as e,y as f,z as u,B as M,C as H,D as z,E as K,u as X,G as q,H as G}from"./vendor-ZmbnWLp6.js";import{A as J}from"./index-DBP474FY.js";import{a as R}from"./main-H3fHEa0S.js";import{_ as Q}from"./_plugin-vue_export-helper-DlAUqK2U.js";const y=b=>(q("data-v-488e55af"),b=b(),G(),b),W={class:"flex justify-center layout-mobi"},Y={class:"grid grid-cols-2 justify-center gap-5 w-screen login_mobi"},Z={class:"col-span-2 lg:col-span-1 flex justify-center"},ee={class:"mt-48 main-mt"},se={class:"d-flex align-items-center flex-column"},ae={class:"text-3xl font-bold leading-10 text-center main-title"},oe=["src"],te={class:"mt-10"},ne={key:0,class:"text-danger"},le={key:1,class:"text-danger"},re=y(()=>o("br",null,null,-1)),de={key:2,class:"text-danger"},ie={class:"text-sm font-bold leading-5 mt-7 text-center max-md:ml-2.5"},ce=y(()=>o("span",null,"Chưa có tài khoản? ",-1)),ue={key:0,class:"text-danger"},pe={key:1,class:"text-danger"},me={key:2,class:"text-danger"},_e={key:3,class:"text-danger"},fe={key:4,class:"text-danger"},ge={key:0,class:"text-danger"},he={key:0,class:"mb-2"},ve={class:"flex"},be={class:"form-group mr-2"},we=y(()=>o("button",{type:"submit",class:"btn css-dev-only-do-not-override-16xcw0g ant-btn ant-btn-primary h-9 bg-secondary"},"Xác Nhận",-1)),xe={class:"text-sm font-bold leading-5 mt-7 text-center max-md:ml-2.5"},ye=y(()=>o("span",null,"Đã có tài khoản? ",-1)),ke={class:"hidden lg:block col-span-1 banner_mobi"},Ce=j({__name:"login",setup(b){K(),X();const{loginForm:w,submitLogin:V,errors:s,resultOtp:S,submitResgiter:U}=J(),$=k({phone:"",password:""}),n=k({phone:"",password:"",confirmPassword:"",referral_code:"",name:"",email:"",otp:"",is_referral:!1}),P=v(""),L=v("");E(async()=>{const m=localStorage.getItem("config");if(m){const i=JSON.parse(m);P.value=`${R.URL}/${i.login_banner}`,L.value=`${R.URL}/${i.logo}`}const _=new URLSearchParams(window.location.search).get("referralcode");_?n.referral_code=_:n.referral_code=""});const A=m=>{console.log("Failed:",m)},x=v(""),B=v(!0),I=m=>{m.preventDefault(),n.otp=x.value,B.value=!1,U(n,"sendotp")},O=m=>{m.preventDefault(),n.otp=x.value,U(n,"register")},g=v(!1);return k([{name:"Dashboard",icon:"HomeFilled",url:"/"},{name:"Cá nhân",icon:"ShoppingCart",url:"/profile"},{name:"Đăng ký",icon:"Key",url:"/signup"},{name:"Đăng nhập",icon:"Avatar",url:"/login"}]),(m,a)=>{const _=h("a-input"),i=h("a-form-item"),D=h("a-button"),N=h("a-form"),F=h("a-input-password"),T=h("a-image");return r(),c("div",W,[o("div",Y,[o("div",Z,[o("main",ee,[o("div",se,[o("h1",ae,p(g.value?"Chào mừng ":"Đăng nhập Affilate"),1),o("img",{src:L.value,alt:"",class:"main-logo text-center mt-2"},null,8,oe)]),o("div",te,[g.value?(r(),C(N,{key:1,model:n,name:"basic",autocomplete:"off",onSubmit:I,class:"w-[360px] lg:w-[400px] h-10",layout:"vertical"},{default:d(()=>[t(i,{label:"Họ và tên",name:"name"},{default:d(()=>[t(_,{value:n.name,"onUpdate:value":a[3]||(a[3]=l=>n.name=l),class:f(["h-10",[e(s).name?"border border-danger":""]])},null,8,["value","class"])]),_:1}),e(s).name?(r(),c("span",ue,p(e(s).name),1)):u("",!0),t(i,{label:"Email",name:"email"},{default:d(()=>[t(_,{value:n.email,"onUpdate:value":a[4]||(a[4]=l=>n.email=l),class:f(["h-10",[e(s).email?"border border-danger":""]])},null,8,["value","class"])]),_:1}),e(s).email?(r(),c("span",pe,p(e(s).email),1)):u("",!0),t(i,{label:"Số diện thoại",name:"phone"},{default:d(()=>[t(_,{value:n.phone,"onUpdate:value":a[5]||(a[5]=l=>n.phone=l),class:f(["h-10",[e(s).phone?"border border-danger":""]])},null,8,["value","class"])]),_:1}),e(s).phone?(r(),c("span",me,p(e(s).phone),1)):u("",!0),t(i,{label:"Mật khẩu",name:"password"},{default:d(()=>[t(F,{value:n.password,"onUpdate:value":a[6]||(a[6]=l=>n.password=l),class:f(["h-10",[e(s).password?"border border-danger":""]])},null,8,["value","class"])]),_:1}),e(s).password?(r(),c("span",_e,p(e(s).password),1)):u("",!0),t(i,{label:"Xác nhận mật khẩu",name:"confirmPassword"},{default:d(()=>[t(F,{value:n.confirmPassword,"onUpdate:value":a[7]||(a[7]=l=>n.confirmPassword=l),class:f(["h-10",[e(s).confirmPassword?"border border-danger":""]])},null,8,["value","class"])]),_:1}),e(s).confirmPassword?(r(),c("span",fe,p(e(s).confirmPassword),1)):u("",!0),t(i,{label:"Mã giới thiệu",name:"referral_code"},{default:d(()=>[t(_,{value:n.referral_code,"onUpdate:value":a[8]||(a[8]=l=>n.referral_code=l),class:f(["h-10",[e(s).referral_code?"border border-danger":""]])},null,8,["value","class"]),e(s).referral_code?(r(),c("span",ge,p(e(s).referral_code),1)):u("",!0)]),_:1}),o("div",null,[e(S).status===!0?(r(),c("div",he,[o("form",{onSubmit:O},[o("div",ve,[o("div",be,[H(o("input",{type:"text",class:"form-control","onUpdate:modelValue":a[9]||(a[9]=l=>x.value=l),placeholder:"Nhập Mã OTP"},null,512),[[z,x.value]])]),we])],32)])):u("",!0)]),e(S).status===!1?(r(),C(i,{key:5},{default:d(()=>[t(D,{type:"primary","html-type":"submit",class:"w-full h-9 bg-secondary"},{default:d(()=>[M("Đăng Ký")]),_:1})]),_:1})):u("",!0),o("p",xe,[ye,o("a",{href:"#",class:"text-teal-300",onClick:a[10]||(a[10]=l=>g.value=!g.value)},"Đăng nhập")])]),_:1},8,["model"])):(r(),C(N,{key:0,model:$,name:"basic",autocomplete:"off",onFinishFailed:A,class:"w-full px-5 lg:px-0 lg:w-[400px] h-10",layout:"vertical"},{default:d(()=>[t(i,{label:"Tài khoản",name:"phone"},{default:d(()=>[t(_,{value:e(w).phone,"onUpdate:value":a[0]||(a[0]=l=>e(w).phone=l),class:f(["h-10",[e(s).phone?"border border-danger":""]])},null,8,["value","class"])]),_:1}),e(s).phone?(r(),c("span",ne,p(e(s).phone),1)):u("",!0),t(i,{label:"Mật khẩu",name:"password"},{default:d(()=>[t(_,{value:e(w).password,"onUpdate:value":a[1]||(a[1]=l=>e(w).password=l),class:f(["h-10",[e(s).password?"border border-danger":""]]),type:"password"},null,8,["value","class"])]),_:1}),e(s).password?(r(),c("span",le,p(e(s).password),1)):u("",!0),re,e(s).errorLogin?(r(),c("span",de,p(e(s).errorLogin),1)):u("",!0),t(i,null,{default:d(()=>[t(D,{type:"submit",class:"w-full h-9 bg-secondary",onClick:e(V)},{default:d(()=>[M(" Đăng nhập ")]),_:1},8,["onClick"])]),_:1}),o("p",ie,[ce,o("a",{href:"#",class:"text-teal-300",onClick:a[2]||(a[2]=l=>g.value=!g.value)},"Đăng ký")])]),_:1},8,["model"]))])])]),o("div",ke,[t(T,{src:P.value,alt:"Decorative image",preview:!1,class:"h-full w-full",style:{width:"100%"}},null,8,["src"])])])])}}}),De=Q(Ce,[["__scopeId","data-v-488e55af"]]);export{De as default};
