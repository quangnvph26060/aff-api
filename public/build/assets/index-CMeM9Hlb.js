import{$ as e,ab as v,ac as n,ad as _,r,q as f,o as g,e as m,g as s,a5 as b,R as x,U as h,B as y}from"./vendor-C9LaRUrm.js";import{_ as S}from"./_plugin-vue_export-helper-DlAUqK2U.js";const B=o=>(x("data-v-80c59b2e"),o=o(),h(),o),I={class:"wrapper font-bold text-2xl text-start",ref:"container"},E=B(()=>s("h1",null,[y(" WEB89"),s("span",{class:"animated-text color-secondary"})],-1)),L=[E],T=b('<div class="letter F" data-v-80c59b2e>WEB</div><div class="letter l" data-v-80c59b2e>8</div><div class="letter i" data-v-80c59b2e>9</div><div class="letter p" data-v-80c59b2e>!</div><div class="for" data-v-80c59b2e>for</div><div class="gsap" data-v-80c59b2e>AFFILIATE</div>',6),k=[T],w={__name:"index",setup(o){e.registerPlugin(v,n,_),e.defaults({ease:"none"}),r(null),r(null);const a=r(null),c=["final","plain","columns","grid"];let t=0;const p=()=>{e.timeline({repeat:-1,repeatDelay:1,yoyo:!0}).to(".animated-text",{duration:4,text:" cung cấp các giải pháp website tổng thể ."})};function d(){if(!a.value)return;const i=n.getState(".letter, .for, .gsap",{props:"color,backgroundColor",simple:!0});a.value.classList.remove(c[t]),t=(t+1)%c.length,a.value.classList.add(c[t]),n.from(i,{absolute:!0,stagger:.07,duration:.7,ease:"power2.inOut",spin:t===0,simple:!0,onEnter:(l,u)=>e.fromTo(l,{opacity:0},{opacity:1,delay:u.duration()-.1}),onLeave:l=>e.to(l,{opacity:0})}),e.delayedCall(t===0?3.5:1.5,d)}return f(()=>{a.value&&e.delayedCall(1,d),p()}),(i,l)=>(g(),m("div",null,[s("div",null,[s("div",I,L,512)]),s("div",{ref_key:"container2",ref:a,class:"container2 final mb-20"},k,512)]))}},N=S(w,[["__scopeId","data-v-80c59b2e"]]);export{N as default};