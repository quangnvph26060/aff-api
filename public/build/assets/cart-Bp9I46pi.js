import{p as C,u as g,a as r,E as y,Z as w}from"./vendor-BijbZa7l.js";import{a as $}from"./main-BqPZiIID.js";function U(){var d;const e=$.baseURL,l=(t,a,s)=>{f({icon:t,html:a,showConfirmButton:s})},h={accept:"application/json",Authorization:"Bearer "+localStorage.getItem("token")};y();const f=w("$swal"),u=g().getters.user,p=((d=u.active_user_package)==null?void 0:d.package[0].reduced_price)??"",o=C({data:[],total:0}),m=async t=>{const a={product_id:t,user_id:u.id,amount:1};try{(await r.post(`${e}cart`,a)).data.status==="success"&&l("success","Đã thêm vào giỏ hàng",!1)}catch(s){console.error(s)}},c=async()=>{try{const t=await r.get(`${e}cart`,{headers:h});if(t.data.status==="success"){o.data=t.data.data;let a=0;o.data.forEach(function(s){let n=s.amount,i=s.product.price;p!=""&&(i=i-i*(p/100)),a+=n*i}),o.total=a}}catch(t){console.error(t)}};return{addToCart:m,getToCart:c,responseCart:o,delToCart:async t=>{try{(await r.delete(`${e}cart/${t}`)).data.status==="success"&&c()}catch(a){console.error(a)}},updateToCart:async(t,a)=>{const s={id:t,amount:a};try{(await r.post(`${e}cart/update/${t}`,s)).data.status==="success"&&c()}catch(n){console.error(n)}},clearCartUser:async()=>{const t={accept:"application/json",Authorization:"Bearer "+localStorage.getItem("token")};try{(await r.post(`${e}cart/clear-cart`,{},{headers:t})).data.status==="success"&&c()}catch(a){console.error(a)}}}}export{U as C};
