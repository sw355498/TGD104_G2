// const navbar = Vue.createApp({
//   data() {
//     return {
//       menulink: [
//         "最新消息",
//         "防範詐騙教學",
//         "回報可疑網站",
//         "政府資訊連結",
//         "詐騙FAQ",
//         "團隊介紹",
//       ],
//       menubtn: ["DEMO體驗", "會員登入/註冊"],
//     };
//   },
// }).mount("#app");

/**
 * canvas
 */
//navbar下方水平線
let canvas = document.getElementById("myCanvas");
let ctx = canvas.getContext("2d");
canvas.height = 2;
let canvasWidth = window.innerWidth * 0.99;
canvas.width = canvasWidth;
ctx.lineWidth = 2;
ctx.strokeStyle = "#ffffff";
ctx.beginPath();
ctx.moveTo(canvasWidth * 0.2, 1);
ctx.lineTo(canvasWidth, 1);
ctx.stroke();
