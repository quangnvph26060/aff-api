import{p as h,a as d,u as P}from"./vendor-ZmbnWLp6.js";import{a as y}from"./main-H3fHEa0S.js";function v(){const s=y.baseURL,n={accept:"application/json",Authorization:"Bearer "+localStorage.getItem("token")},a=h({data:[],productCategory:[]}),i=P();return{getProduct:async()=>{var r;try{const t=await d.get(`${s}products`,{headers:n});if(t.data.status==="success"){const o=await i.getters.user;a.data=t.data.data;const e=((r=o.active_user_package)==null?void 0:r.package[0].reduced_price)??"";e&&a.data.forEach(c=>{c.price=c.price-c.price*(e/100)})}}catch(t){console.error("Error fetching the product:",t)}},responseProduct:a,findProduct:async r=>{var t,o;try{const e=await d.post(`${s}products/${r}`);if(e.data.status==="success"){a.data=e.data.data;const p=((t=(await i.getters.user).active_user_package)==null?void 0:t.package[0].reduced_price)??"";p&&(a.data.price=a.data.price-a.data.price*(p/100));const g=await d.post(`${s}products/bycategory/${a.data.category_id}`);if(g.data.status==="success"){a.productCategory=g.data.data;const f=((o=(await i.getters.user).active_user_package)==null?void 0:o.package[0].reduced_price)??"";f&&a.productCategory.forEach(u=>{u.price=u.price-u.price*(f/100)})}}}catch(e){console.error("Error fetching the product:",e)}},searchProduct:async r=>{try{const t=await d.post(`${s}search-product`,{searchValues:r},{headers:n});t.data.status==="success"&&(a.data=t.data.data)}catch(t){console.error(t)}},getProductTop:async()=>{var r;try{const t=await d.get(`${s}products/get-product-top `,{headers:n});if(t.status===200){a.data=t.data;const e=((r=(await i.getters.user).active_user_package)==null?void 0:r.package[0].reduced_price)??"";e&&a.data.forEach(c=>{c.price=c.price-c.price*(e/100)})}}catch(t){console.error("Error fetching the product:",t)}}}}export{v as P};