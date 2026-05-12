const button = document.getElementById('btn');
const input = document.getElementById('code');
const message = document.getElementById('msg');

const gateToken = "synt{sebagraq_nhgu_vf_abg_frphevgl}";

button.addEventListener('click', () => {
  if (input.value.trim() === gateToken) {
    message.textContent = '測試登入成功';
    message.style.color = 'green';
  } else {
    message.textContent = '通關碼錯誤';
    message.style.color = 'crimson';
  }
});

console.log('[hint] gateToken is protected with a classic Caesar variant');
