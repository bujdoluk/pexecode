<?php /** @var array $game */ /** @var array $conceptMap */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PeXECode — PHP Memory Game</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.10.0/styles/atom-one-dark.min.css">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Segoe UI', system-ui, sans-serif;
    background: #0f1117;
    color: #e2e8f0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 24px;
    background: #1a1d2e;
    border-bottom: 1px solid #2d3148;
    position: sticky;
    top: 0;
    z-index: 100;
  }

  header h1 {
    font-size: 1.4rem;
    font-weight: 700;
    color: #7c8dff;
    letter-spacing: 1px;
  }

  .stats {
    display: flex;
    gap: 24px;
    align-items: center;
  }

  .stat {
    text-align: center;
  }

  .stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #7c8dff;
    line-height: 1;
  }

  .stat-label {
    font-size: 0.7rem;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 2px;
  }

  .reset-btn {
    padding: 8px 18px;
    background: #2d3148;
    border: 1px solid #4a5180;
    border-radius: 8px;
    color: #a0aec0;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.2s;
  }

  .reset-btn:hover { background: #3a3f6e; color: #fff; }

  .board-wrapper {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
  }

  .board {
    display: grid;
    grid-template-columns: repeat(10, 80px);
    grid-auto-rows: 80px;
    gap: 6px;
  }

  .card {
    width: 80px;
    height: 80px;
    perspective: 600px;
    cursor: pointer;
  }

  .card-inner {
    width: 100%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d;
    transition: transform 0.45s cubic-bezier(.4,0,.2,1);
    border-radius: 8px;
  }

  .card.flipped .card-inner,
  .card.matched .card-inner {
    transform: rotateY(180deg);
  }

  .card-face {
    position: absolute;
    inset: 0;
    border-radius: 8px;
    backface-visibility: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.65rem;
    font-weight: 600;
  }

  .card-back {
    background: #1a2d50;
    background-image: url('/php-logo.svg');
    background-size: 82% auto;
    background-repeat: no-repeat;
    background-position: center;
    border: 1px solid #2b6cb0;
  }

  .card-front {
    background: linear-gradient(135deg, #1e2240, #2d3148);
    border: 1px solid #3a3f6e;
    transform: rotateY(180deg);
    flex-direction: column;
    gap: 3px;
    padding: 5px 4px;
    overflow: hidden;
  }

  .card.matched .card-front {
    background: linear-gradient(135deg, #163025, #1a3c2d);
    border-color: #38a169;
  }

  .card-name {
    font-family: monospace;
    font-size: 0.68rem;
    font-weight: 700;
    color: #63b3ed;
    text-align: center;
    word-break: break-all;
    line-height: 1.2;
  }

  .card.matched .card-name { color: #68d391; }

  .info-btn {
    position: absolute;
    top: 3px;
    right: 3px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: rgba(99,179,237,0.2);
    border: 1px solid rgba(99,179,237,0.5);
    color: #63b3ed;
    font-size: 8px;
    font-weight: 700;
    font-style: italic;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    line-height: 1;
    transition: background 0.2s;
  }

  .info-btn:hover { background: rgba(99,179,237,0.45); }
  .card.matched .info-btn { border-color: rgba(104,211,145,0.5); color: #68d391; background: rgba(104,211,145,0.15); }

  /* Modal */
  .modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.75);
    z-index: 200;
    align-items: center;
    justify-content: center;
    padding: 16px;
  }

  .modal-overlay.active { display: flex; }

  .modal {
    background: #1a1d2e;
    border: 1px solid #3a3f6e;
    border-radius: 12px;
    padding: 28px;
    max-width: 680px;
    width: 100%;
    position: relative;
    max-height: 90vh;
    overflow-y: auto;
  }

  .modal-header {
    display: flex;
    align-items: baseline;
    gap: 10px;
    margin-bottom: 12px;
  }

  .modal h2 {
    font-family: monospace;
    font-size: 1.3rem;
    color: #7c8dff;
    margin: 0;
  }

  .version-badge {
    font-size: 0.7rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
    background: #2d3148;
    border: 1px solid #4a5180;
    color: #a0aec0;
    letter-spacing: 0.3px;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .modal p {
    color: #a0aec0;
    line-height: 1.7;
    font-size: 0.92rem;
    margin-bottom: 16px;
  }

  .modal-code-wrap {
    position: relative;
    margin-bottom: 16px;
  }

  .modal-code-label {
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #4a5180;
    margin-bottom: 6px;
  }

  .modal pre {
    border: 1px solid #2d3148;
    border-radius: 8px;
    overflow-x: auto;
    font-size: 0.8rem;
    line-height: 1.65;
  }

  .modal pre code.hljs {
    background: #0d0f1a !important;
    border-radius: 8px;
    padding: 16px !important;
    font-family: 'Fira Code', 'Cascadia Code', 'Consolas', monospace;
    font-size: inherit;
    line-height: inherit;
    tab-size: 4;
  }

  .copy-btn {
    position: absolute;
    top: 24px;
    right: 8px;
    padding: 3px 10px;
    font-size: 0.7rem;
    background: #2d3148;
    border: 1px solid #4a5180;
    border-radius: 5px;
    color: #a0aec0;
    cursor: pointer;
    transition: all 0.15s;
  }

  .copy-btn:hover { background: #3a3f6e; color: #fff; }
  .copy-btn.copied { border-color: #38a169; color: #68d391; }

  .modal-doc {
    display: inline-block;
    color: #63b3ed;
    font-size: 0.82rem;
    text-decoration: none;
  }

  .modal-doc:hover { text-decoration: underline; }

  .modal-close {
    position: absolute;
    top: 12px;
    right: 14px;
    background: none;
    border: none;
    color: #718096;
    font-size: 1.3rem;
    cursor: pointer;
    line-height: 1;
  }

  .modal-close:hover { color: #fff; }

  /* Toast */
  .toast {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: #2d3748;
    color: #68d391;
    padding: 10px 24px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    border: 1px solid #38a169;
    transition: transform 0.3s ease;
    z-index: 300;
    white-space: nowrap;
  }

  .toast.show { transform: translateX(-50%) translateY(0); }

  .card.disabled { cursor: default; pointer-events: none; }

  /* 600px – 1200px: fill available viewport space */
  @media (max-width: 1200px) {
    .board-wrapper {
      padding: 10px;
      /* --cs = min(width-based size, height-based size)
         width:  (100vw - 2×10px padding - 9×5px gaps) / 10
         height: (100dvh - ~68px header - 2×10px padding - 9×5px gaps) / 10 */
      --cs: min(
        calc((100vw  - 20px - 45px) / 10),
        calc((100dvh - 68px - 20px - 45px) / 10)
      );
    }
    .board {
      grid-template-columns: repeat(10, var(--cs));
      grid-auto-rows: var(--cs);
      gap: 5px;
    }
    .card { width: var(--cs); height: var(--cs); }
    .card-name { font-size: 0.58rem; }
  }

  /* < 600px: tighter padding and gaps to maximise card area */
  @media (max-width: 600px) {
    header { padding: 8px 12px; }
    header h1 { font-size: 1.1rem; }
    .stat-value { font-size: 1.2rem; }
    .stats { gap: 14px; }

    .board-wrapper {
      padding: 4px;
      /* header shrinks to ~48px on mobile */
      --cs: min(
        calc((100vw  - 8px - 27px) / 10),
        calc((100dvh - 48px - 8px - 27px) / 10)
      );
    }
    .board { gap: 3px; }
    .card-name { font-size: 0.45rem; }
    .info-btn  { width: 11px; height: 11px; font-size: 7px; top: 2px; right: 2px; }
  }
</style>
</head>
<body>

<header>
  <h1>PeXECode</h1>
  <div class="stats">
    <div class="stat">
      <div class="stat-value" id="score"><?= $game['score'] ?></div>
      <div class="stat-label">PHP Constructs Found</div>
    </div>
    <div class="stat">
      <div class="stat-value" id="moves"><?= $game['moves'] ?></div>
      <div class="stat-label">Attempts</div>
    </div>
    <div class="stat">
      <div class="stat-value">50</div>
      <div class="stat-label">Constructs in Game</div>
    </div>
  </div>
  <form method="POST" action="/reset" style="margin:0">
    <button type="submit" class="reset-btn">New Game</button>
  </form>
</header>

<div class="board-wrapper">
  <div class="board" id="board">
    <?php for ($r = 0; $r < 10; $r++): ?>
      <?php for ($c = 0; $c < 10; $c++): ?>
        <?php
          $cell = $game['board'][$r][$c];
          $concept = $conceptMap[$cell['concept_id']];
          $isFlipped = $cell['flipped'] ? 'flipped' : '';
          $isMatched = $cell['matched'] ? 'matched' : '';
          $isDisabled = $cell['matched'] ? 'disabled' : '';
        ?>
        <div
          class="card <?= $isFlipped ?> <?= $isMatched ?> <?= $isDisabled ?>"
          data-row="<?= $r ?>"
          data-col="<?= $c ?>"
          data-concept-id="<?= $concept['id'] ?>"
          data-concept-name="<?= htmlspecialchars($concept['short']) ?>"
          data-concept-version="<?= htmlspecialchars($concept['version']) ?>"
          data-concept-detail="<?= htmlspecialchars($concept['detail']) ?>"
          data-concept-code="<?= htmlspecialchars($concept['code']) ?>"
          data-concept-doc="<?= htmlspecialchars($concept['doc_url']) ?>"
        >
          <div class="card-inner">
            <div class="card-back card-face"></div>
            <div class="card-front card-face">
              <button class="info-btn" onclick="showModal(event,this)">i</button>
              <div class="card-name"><?= htmlspecialchars($concept['short']) ?></div>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    <?php endfor; ?>
  </div>
</div>

<div class="modal-overlay" id="modalOverlay">
  <div class="modal">
    <button class="modal-close" onclick="closeModal()">&times;</button>
    <div class="modal-header">
      <h2 id="modalTitle"></h2>
      <span class="version-badge" id="modalVersion"></span>
    </div>
    <p id="modalDetail"></p>
    <div class="modal-code-wrap">
      <div class="modal-code-label">Example</div>
      <button class="copy-btn" id="copyBtn" onclick="copyCode()">Copy</button>
      <pre><code id="modalCode" class="language-php"></code></pre>
    </div>
    <a id="modalDoc" class="modal-doc" href="#" target="_blank" rel="noopener">PHP Documentation &rarr;</a>
  </div>
</div>

<div class="toast" id="toast"></div>

<script>
(function() {
  let busy = false;
  let flippedCount = 0;
  let unflipTimer = null;

  const board = document.getElementById('board');
  const scoreEl = document.getElementById('score');
  const movesEl = document.getElementById('moves');
  const toast = document.getElementById('toast');

  // Count already-flipped on page load
  document.querySelectorAll('.card.flipped:not(.matched)').forEach(() => flippedCount++);

  board.addEventListener('click', async (e) => {
    const card = e.target.closest('.card');
    if (!card) return;
    if (card.classList.contains('matched')) return;
    if (card.classList.contains('flipped')) return;
    if (busy) return;
    if (flippedCount >= 2) return;

    const row = card.dataset.row;
    const col = card.dataset.col;

    busy = true;
    card.classList.add('flipped');
    flippedCount++;

    try {
      const res = await fetch(`/flip/${row}/${col}`, { method: 'POST' });
      const data = await res.json();

      if (data.status === 'noop' || data.status === 'max_flipped') {
        card.classList.remove('flipped');
        flippedCount--;
        busy = false;
        return;
      }

      scoreEl.textContent = data.score;
      movesEl.textContent = data.moves;

      if (data.matched) {
        // Mark both flipped cards as matched
        document.querySelectorAll('.card.flipped:not(.matched)').forEach(c => {
          c.classList.add('matched', 'disabled');
        });
        flippedCount = 0;
        showToast('Match! +1');
      } else if (data.unflip_after) {
        // Wait then unflip
        await delay(900);
        await doUnflip();
        flippedCount = 0;
      }
    } catch (err) {
      console.error(err);
      card.classList.remove('flipped');
      flippedCount = Math.max(0, flippedCount - 1);
    }

    busy = false;
  });

  async function doUnflip() {
    try {
      await fetch('/unflip', { method: 'POST' });
      document.querySelectorAll('.card.flipped:not(.matched)').forEach(c => {
        c.classList.remove('flipped');
      });
    } catch (e) { console.error(e); }
  }

  function delay(ms) { return new Promise(r => setTimeout(r, ms)); }

  let toastTimer;
  function showToast(msg) {
    toast.textContent = msg;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('show'), 1800);
  }

  window.showModal = function(e, btn) {
    e.stopPropagation();
    const card    = btn.closest('.card');
    const codeEl  = document.getElementById('modalCode');

    document.getElementById('modalTitle').textContent   = card.dataset.conceptName;
    document.getElementById('modalVersion').textContent = card.dataset.conceptVersion;
    document.getElementById('modalDetail').textContent  = card.dataset.conceptDetail;
    document.getElementById('modalDoc').href            = card.dataset.conceptDoc;
    document.getElementById('copyBtn').textContent      = 'Copy';
    document.getElementById('copyBtn').classList.remove('copied');

    codeEl.textContent = card.dataset.conceptCode;
    codeEl.removeAttribute('data-highlighted');
    hljs.highlightElement(codeEl);

    document.getElementById('modalOverlay').classList.add('active');
  };

  window.copyCode = function() {
    const code = document.getElementById('modalCode').innerText;
    navigator.clipboard.writeText(code).then(() => {
      const btn = document.getElementById('copyBtn');
      btn.textContent = 'Copied!';
      btn.classList.add('copied');
      setTimeout(() => { btn.textContent = 'Copy'; btn.classList.remove('copied'); }, 2000);
    });
  };

  window.closeModal = function() {
    document.getElementById('modalOverlay').classList.remove('active');
  };

  document.getElementById('modalOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });
})();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.10.0/highlight.min.js"></script>
</body>
</html>
