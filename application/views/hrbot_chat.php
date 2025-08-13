<div class="container my-4">
  <div class="row">
    <div class="col-12 col-md-10 col-lg-8 mx-auto">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <strong>HR Department Bot</strong>
        </div>
        <div class="card-body">
          <div id="chatWindow" style="height:320px; overflow-y:auto; border:1px solid #e9ecef; padding:12px; border-radius:4px; background:#fafafa">
            <div class="text-muted mb-2">Type your HR question below. Try: "How do I register for BPJS?"</div>
          </div>

          <form id="chatForm" class="mt-3" autocomplete="off">
            <div class="input-group">
              <input type="text" id="message" name="message" class="form-control" placeholder="Ask about BPJS, payroll, attendance, policies..." required>
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="mt-3 small text-muted">
        Tips: ask about BPJS registration, payroll dates, pay slips, leave policy, reporting concerns, or bot features like reminders.
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  var chatForm = document.getElementById('chatForm');
  var messageInput = document.getElementById('message');
  var chatWindow = document.getElementById('chatWindow');
  var isSubmitting = false;

  function appendBubble(text, role) {
    var wrapper = document.createElement('div');
    wrapper.className = 'mb-2';
    var bubble = document.createElement('div');
    bubble.className = role === 'user' ? 'p-2 bg-light border rounded' : 'p-2 bg-white border rounded';
    bubble.textContent = text;
    wrapper.appendChild(bubble);
    chatWindow.appendChild(wrapper);
    chatWindow.scrollTop = chatWindow.scrollHeight;
  }

  chatForm.addEventListener('submit', function(e){
    e.preventDefault();
    if (isSubmitting) return;
    var text = (messageInput.value || '').trim();
    if (!text) return;

    appendBubble(text, 'user');
    messageInput.value = '';

    isSubmitting = true;
    var formData = new FormData();
    formData.append('message', text);

    fetch("<?php echo base_url('index.php/hrbot/ask'); ?>", {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    }).then(function(res){ return res.json(); })
      .then(function(json){
        if (json && json.reply) {
          appendBubble(json.reply, 'bot');
        } else {
          appendBubble('Sorry, something went wrong. Please try again.', 'bot');
        }
      })
      .catch(function(){
        appendBubble('Network error. Please try again.', 'bot');
      })
      .finally(function(){
        isSubmitting = false;
        messageInput.focus();
      });
  });
})();
</script>