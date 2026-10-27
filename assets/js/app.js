// Theme toggle (localStorage + prefers-color-scheme), burger, live table search, reveal, count-up, toast
const root=document.documentElement,saved=localStorage.getItem('theme');
root.dataset.theme=saved||(matchMedia('(prefers-color-scheme:dark)').matches?'dark':'light');
document.addEventListener('click',e=>{
 if(e.target.id==='theme'){root.dataset.theme=root.dataset.theme==='dark'?'light':'dark';localStorage.setItem('theme',root.dataset.theme);}
 if(e.target.id==='burger')document.getElementById('side').classList.toggle('open');});
document.querySelectorAll('.search').forEach(i=>i.addEventListener('input',()=>{
 document.querySelectorAll(i.dataset.table+' tr').forEach((r,k)=>{if(k)r.style.display=r.textContent.toLowerCase().includes(i.value.toLowerCase())?'':'none'})}));
const io=new IntersectionObserver(es=>es.forEach(x=>x.isIntersecting&&x.target.classList.add('in')));
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
document.querySelectorAll('[data-count]').forEach(el=>{const n=+el.dataset.count;let v=0;const t=setInterval(()=>{v+=Math.ceil(n/30);if(v>=n){v=n;clearInterval(t)}el.textContent=v},30)});
function toast(m){const t=document.getElementById('toast');t.textContent=m;t.style.display='block';setTimeout(()=>t.style.display='none',2500)}
