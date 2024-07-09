import{O as B}from"./order-BrOXOzfY.js";import{u as R}from"./useFormatCurrency-ovqMsPCw.js";import{n as I,r as T,q as L,p as O,d as _,o as l,x as A,w as e,g as a,f as t,h as y,a6 as F,B as i,a7 as M,e as r,F as b,H as Q,z,v as f,a8 as X,a9 as j}from"./vendor-C9LaRUrm.js";import"./main-CcAQTw76.js";const G={style:{padding:"8px"}},J={key:0},U={key:1,class:"space-x-3"},W={key:2},Y={key:3},Z=I({__name:"index",setup(S){const{getOrder:C,responseOrder:w}=B();T(5);const s=T([]);L(async()=>{await C(),s.value=w.data,console.log(s.value)});const m=T(),c=O({searchText:"",searchedColumn:""}),g=(n,o,x)=>{o(),c.searchText=n[0],c.searchedColumn=x},N=n=>{n({confirm:!0}),c.searchText=""},D=[{title:"Tên",dataIndex:"name",customFilterDropdown:!0,onFilter:(n,o)=>o.name.toString().toLowerCase().includes(n.toLowerCase()),onFilterDropdownOpenChange:n=>{n&&setTimeout(()=>{m.value.focus()},100)},width:250},{title:"Ngày tạo",dataIndex:"created_at",width:250},{title:"Trạng thái",dataIndex:"status",filters:[{text:"Chờ xử lý",value:1},{text:"Đang vận chuyển",value:2},{text:"Đã giao hàng",value:3},{text:"Đã hủy",value:4},{text:"Đã hoàn tiền",value:5},{text:"Tạm dừng",value:6},{text:"Thất bại",value:7}],onFilter:(n,o)=>o.level.indexOf(n)===1,width:160},{title:"Tổng tiền",dataIndex:"total_money",sorter:{compare:(n,o)=>n.total-o.total},width:200},{title:"Hành động",dataIndex:"operation",width:200}];function E(n,o,x,h){console.log("params",n,o,x,h)}const V=O({pageSize:10,showSizeChanger:!0,responsive:!0,showLessItems:!0,onChange:(n,o)=>{}});function q(n){switch(n){case 1:return"Chờ xử lý ";case 2:return"Đang vận chuyển";case 3:return"Đã giao hàng";case 4:return"Đã hủy";case 5:return"Đã hoàn tiền";case 6:return"Tạm dừng";case 7:return"Thất bại";default:return""}}return(n,o)=>{const x=_("a-input"),h=_("a-button"),H=_("a-tag"),P=_("a-table");return l(),A(P,{columns:D,"data-source":s.value,onChange:E,pagination:V,scroll:{x:1200}},{customFilterDropdown:e(({setSelectedKeys:d,selectedKeys:u,confirm:p,clearFilters:k,column:$})=>[a("div",G,[t(x,{ref_key:"searchInput",ref:m,placeholder:`Tìm ${$.title}`,value:u[0],style:{width:"188px","margin-bottom":"8px",display:"block"},onChange:v=>d(v.target.value?[v.target.value]:[]),onPressEnter:v=>g(u,p,$.dataIndex)},null,8,["placeholder","value","onChange","onPressEnter"]),t(h,{type:"primary",size:"small",style:{width:"90px","margin-right":"8px"},onClick:v=>g(u,p,$.dataIndex)},{icon:e(()=>[t(y(F))]),default:e(()=>[i(" Tìm ")]),_:2},1032,["onClick"]),t(h,{size:"small",style:{width:"90px"},onClick:v=>N(k)},{default:e(()=>[i(" Đặt lại ")]),_:2},1032,["onClick"])])]),customFilterIcon:e(({filtered:d})=>[t(y(F),{style:M({color:d?"#108ee9":void 0})},null,8,["style"])]),bodyCell:e(({column:d,text:u})=>[c.searchText&&c.searchedColumn===d.dataIndex?(l(),r("span",J,[(l(!0),r(b,null,Q(u.toString().split(new RegExp(`(?<=${c.searchText})|(?=${c.searchText})`,"i")),(p,k)=>(l(),r(b,null,[p.toLowerCase()===c.searchText.toLowerCase()?(l(),r("mark",{key:k,class:"highlight"},f(p),1)):(l(),r(b,{key:1},[i(f(p),1)],64))],64))),256))])):z("",!0),d.dataIndex==="operation"?(l(),r("div",U,[t(h,{size:"small"},{default:e(()=>[i(" Sửa ")]),_:1}),t(h,{type:"primary",size:"small",danger:""},{default:e(()=>[i(" Xóa ")]),_:1})])):d.dataIndex==="status"?(l(),r("div",W,[t(H,null,{default:e(()=>[i(f(q(u)),1)]),_:2},1024)])):d.dataIndex==="total_money"?(l(),r("div",Y,f(y(R)(u)),1)):z("",!0)]),_:1},8,["data-source","pagination"])}}}),K=a("p",null,"Solve initial network problems 1",-1),ee=a("p",null,"Solve initial network problems 3 2015-09-01",-1),te=a("p",null,"Technical testing 1",-1),ne=a("p",null,"Technical testing 3 2015-09-01",-1),ae=a("p",null,"Technical testing 1",-1),se=a("p",null,"Technical testing 3 2015-09-01",-1),oe=a("p",null,"Technical testing 1",-1),le=a("p",null,"Technical testing 3 2015-09-01",-1),re=a("p",null,"Custom color testing",-1),ie=I({__name:"Overview",setup(S){return(C,w)=>{const s=_("a-timeline-item"),m=_("a-timeline");return l(),r("main",null,[t(m,null,{default:e(()=>[t(s,{color:"green"},{default:e(()=>[i("Create a services site 2015-09-01")]),_:1}),t(s,{color:"green"},{default:e(()=>[i("Create a services site 2015-09-01")]),_:1}),t(s,{color:"red"},{default:e(()=>[K,ee]),_:1}),t(s,null,{default:e(()=>[te,ne]),_:1}),t(s,{color:"gray"},{default:e(()=>[ae,se]),_:1}),t(s,{color:"gray"},{default:e(()=>[oe,le]),_:1}),t(s,{color:"#00CCFF"},{dot:e(()=>[t(y(X))]),default:e(()=>[re]),_:1})]),_:1})])}}}),ce=a("span",{class:"font-bold"},"Quản lý đơn hàng",-1),de={class:"flex items-center text-xs text-green-500 mt-1"},ue={class:"mt-4"},_e=a("span",{class:"font-bold"},"Tổng quan đơn hàng",-1),he=a("p",{class:"mb-4 text-slate-400"},[a("span",{class:"font-bold text-green-400"},"+30%"),i(" tháng này ")],-1),ve=I({__name:"index",setup(S){const{getOrder:C,responseOrder:w}=B(),s=T(0);return L(async()=>{await C(),s.value=w.count}),(m,c)=>{const g=_("a-card");return l(),r("div",null,[t(g,null,{title:e(()=>[ce,a("div",de,[t(y(j),{class:"mr-1"}),i(" "+f(s.value)+" đơn thành công ",1)])]),default:e(()=>[t(Z)]),_:1}),a("div",ue,[t(g,{class:"leading-5 max-w-[500px]"},{title:e(()=>[_e]),default:e(()=>[he,t(ie)]),_:1})])])}}});export{ve as default};
