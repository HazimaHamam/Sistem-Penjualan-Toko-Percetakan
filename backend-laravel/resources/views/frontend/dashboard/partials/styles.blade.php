<style>
/* ═══════════════════════════════════════════════
   TOKENS
═══════════════════════════════════════════════ */
:root {
    --bg:          #0f0e0c;
    --bg-2:        #161512;
    --bg-3:        #1e1c18;
    --bg-4:        #252320;
    --line:        rgba(255,255,255,0.07);
    --line-soft:   rgba(255,255,255,0.04);
    --text-1:      #f5f3ef;
    --text-2:      #a8a098;
    --text-3:      #6b665e;
    --accent:      #7c6dfa;       /* indigo-violet */
    --accent-glow: rgba(124,109,250,0.18);
    --gold:        #e8b84b;
    --emerald:     #34d399;
    --amber:       #fbbf24;
    --red:         #f87171;
    --r:           18px;          /* card radius */
}

/* ═══════════════════════════════════════════════
   LAYOUT
═══════════════════════════════════════════════ */
.db-root {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    position: relative;
    z-index: 1;
}
.db-mid-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
}
@media (min-width: 1024px) {
    .db-mid-grid { grid-template-columns: 1fr 340px; }
}

/* Background mesh — subtle warm radials */
.db-root::before {
    content: '';
    position: fixed;
    inset: 0;
    background:
        radial-gradient(ellipse 600px 400px at 80% 0%, rgba(124,109,250,0.07) 0%, transparent 70%),
        radial-gradient(ellipse 400px 400px at 10% 90%, rgba(52,211,153,0.04) 0%, transparent 60%);
    pointer-events: none;
    z-index: -1;
}

/* ═══════════════════════════════════════════════
   ANIMATIONS
═══════════════════════════════════════════════ */
@keyframes rise {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes fade {
    from { opacity: 0; }
    to   { opacity: 1; }
}
@keyframes glow-pulse {
    0%, 100% { opacity: 0.6; }
    50%       { opacity: 1; }
}
@keyframes bar-in {
    from { width: 0 !important; }
}

.u-rise { opacity: 0; animation: rise 0.6s cubic-bezier(.16,1,.3,1) forwards; }
.u-fade { opacity: 0; animation: fade 0.5s ease forwards; }

.d1  { animation-delay: 0.05s; }
.d2  { animation-delay: 0.13s; }
.d3  { animation-delay: 0.21s; }
.d4  { animation-delay: 0.29s; }
.d5  { animation-delay: 0.37s; }
.d6  { animation-delay: 0.45s; }

/* ═══════════════════════════════════════════════
   GLASS CARD BASE
═══════════════════════════════════════════════ */
.card {
    background: var(--bg-2);
    border: 1px solid var(--line);
    border-radius: var(--r);
    position: relative;
    overflow: hidden;
}
/* Top edge highlight */
.card::before {
    content: '';
    position: absolute;
    top: 0; left: 10%; right: 10%;
    height: 1px;
    background: linear-gradient(90deg,
        transparent,
        rgba(255,255,255,0.12) 40%,
        rgba(255,255,255,0.12) 60%,
        transparent);
    pointer-events: none;
}

/* ═══════════════════════════════════════════════
   STAT CARDS
═══════════════════════════════════════════════ */
.stat-card {
    composes: card;
    padding: 1.375rem 1.5rem 1.25rem;
    transition: transform 0.28s cubic-bezier(.16,1,.3,1),
                box-shadow 0.28s ease,
                border-color 0.28s ease;
}
.stat-card:hover {
    transform: translateY(-5px);
    border-color: rgba(255,255,255,0.13);
    box-shadow: 0 16px 48px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.05);
}

/* Ambient glow per card */
.stat-card .glow {
    position: absolute;
    top: -60px; right: -60px;
    width: 180px; height: 180px;
    border-radius: 50%;
    opacity: 0.12;
    pointer-events: none;
    transition: opacity 0.3s;
    filter: blur(40px);
}
.stat-card:hover .glow { opacity: 0.22; }

.stat-icon {
    width: 2.25rem; height: 2.25rem;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    transition: transform 0.3s cubic-bezier(.16,1,.3,1);
    flex-shrink: 0;
}
.stat-card:hover .stat-icon { transform: scale(1.12) rotate(-7deg); }

.stat-num {
    font-family: var(--font-serif, 'DM Serif Display', serif);
    font-size: 3rem;
    line-height: 1;
    color: var(--text-1);
    letter-spacing: -0.02em;
    transition: transform 0.28s cubic-bezier(.16,1,.3,1);
    display: block;
}
.stat-card:hover .stat-num { transform: scale(1.04) translateX(2px); }

.stat-label {
    font-size: 0.7rem;
    color: var(--text-3);
    font-weight: 500;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    margin-top: 0.5rem;
}

/* Accent card */
.stat-card-accent {
    background: linear-gradient(135deg, #3730a3 0%, #5b21b6 100%);
    border-color: rgba(124,109,250,0.35);
    box-shadow: 0 8px 36px rgba(55,48,163,0.45);
}
.stat-card-accent:hover {
    box-shadow: 0 16px 56px rgba(55,48,163,0.55), 0 0 0 1px rgba(124,109,250,0.4);
}
.stat-card-accent .stat-num { color: #fff; }
.stat-card-accent .stat-label { color: rgba(199,210,254,0.7); }

/* Progress track */
.prog {
    height: 2px;
    border-radius: 99px;
    background: rgba(255,255,255,0.06);
    overflow: hidden;
    margin-top: 1rem;
}
.prog-fill {
    height: 100%;
    border-radius: 99px;
    animation: bar-in 1.1s cubic-bezier(.16,1,.3,1) forwards;
}
.stat-card-accent .prog { background: rgba(255,255,255,0.15); }

/* ═══════════════════════════════════════════════
   PANEL (chart, activity, table)
═══════════════════════════════════════════════ */
.panel {
    background: var(--bg-2);
    border: 1px solid var(--line);
    border-radius: var(--r);
    overflow: hidden;
    position: relative;
}
.panel::before {
    content: '';
    position: absolute;
    top: 0; left: 10%; right: 10%;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1) 50%, transparent);
    pointer-events: none;
}
.panel-hd {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 1.125rem 1.5rem;
    border-bottom: 1px solid var(--line-soft);
}
.panel-eyebrow {
    font-size: 0.625rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--text-3);
    margin-bottom: 0.2rem;
}
.panel-title {
    font-family: var(--font-serif, 'DM Serif Display', serif);
    font-size: 0.9375rem;
    color: var(--text-1);
    font-weight: 400;
}

/* ═══════════════════════════════════════════════
   CHART CHIPS
═══════════════════════════════════════════════ */
.chip-row {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 0.75rem 1.5rem;
    background: var(--bg-3);
    border-bottom: 1px solid var(--line-soft);
}
.chip { display: flex; flex-direction: column; gap: 1px; }
.chip-lbl { font-size: 0.65rem; color: var(--text-3); font-weight: 500; }
.chip-val { font-size: 0.8125rem; font-weight: 700; color: var(--text-1); }
.chip-divider { width: 1px; height: 1.75rem; background: var(--line); flex-shrink: 0; }

/* ═══════════════════════════════════════════════
   SKELETON
═══════════════════════════════════════════════ */
@keyframes shimmer {
    0%   { background-position: -600px 0; }
    100% { background-position:  600px 0; }
}
.skel {
    background: linear-gradient(90deg, var(--bg-3) 25%, var(--bg-4) 50%, var(--bg-3) 75%);
    background-size: 600px 100%;
    animation: shimmer 1.6s infinite linear;
    border-radius: 6px;
}

/* ═══════════════════════════════════════════════
   TIMELINE
═══════════════════════════════════════════════ */
.tl-item { position: relative; }
.tl-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 12px; top: 30px; bottom: 0;
    width: 1px;
    background: linear-gradient(to bottom, var(--line), transparent);
}

/* ═══════════════════════════════════════════════
   TABLE
═══════════════════════════════════════════════ */
.tbl { width: 100%; border-collapse: collapse; font-size: 0.8125rem; }
.tbl thead tr { background: var(--bg-3); border-bottom: 1px solid var(--line-soft); }
.tbl th {
    padding: 0.625rem 1.25rem;
    text-align: left;
    font-size: 0.625rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-3);
}
.tbl th:last-child { text-align: right; }
.tbl td { padding: 0.875rem 1.25rem; border-bottom: 1px solid var(--line-soft); }
.tbl td:last-child { text-align: right; }
.tbl tbody tr:last-child td { border-bottom: none; }

.tbl-row {
    cursor: pointer;
    position: relative;
    transition: background 0.12s;
}
.tbl-row::after {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 2px;
    background: var(--accent);
    opacity: 0;
    transition: opacity 0.15s;
}
.tbl-row:hover { background: rgba(255,255,255,0.03); }
.tbl-row:hover::after { opacity: 0.5; }
.tbl-row.active { background: rgba(124,109,250,0.07); }
.tbl-row.active::after { opacity: 1; }
.tbl-row.active td:first-child { padding-left: 1.625rem; }

/* ═══════════════════════════════════════════════
   BADGES
═══════════════════════════════════════════════ */
.bdg {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 9px;
    border-radius: 99px;
    font-size: 0.68rem;
    font-weight: 600;
}
.bdg-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
.bdg-done     { background: rgba(52,211,153,0.12); color: #6ee7b7; border: 1px solid rgba(52,211,153,0.2); }
.bdg-done     .bdg-dot { background: var(--emerald); }
.bdg-proc     { background: rgba(251,191,36,0.1);  color: #fcd34d; border: 1px solid rgba(251,191,36,0.2); }
.bdg-proc     .bdg-dot { background: var(--amber); }
.bdg-pend     { background: rgba(255,255,255,0.06); color: var(--text-2); border: 1px solid var(--line); }
.bdg-pend     .bdg-dot { background: var(--text-3); }
.bdg-cancel   { background: rgba(248,113,113,0.1);  color: #fca5a5; border: 1px solid rgba(248,113,113,0.2); }
.bdg-cancel   .bdg-dot { background: var(--red); }

/* ═══════════════════════════════════════════════
   MISC UTILITIES
═══════════════════════════════════════════════ */
.live-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--emerald);
    animation: glow-pulse 2.5s ease-in-out infinite;
    flex-shrink: 0;
}
.pill-link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--accent);
    background: rgba(124,109,250,0.1);
    border: 1px solid rgba(124,109,250,0.25);
    padding: 0.3rem 0.75rem;
    border-radius: 99px;
    text-decoration: none;
    transition: background 0.15s, border-color 0.15s;
}
.pill-link:hover { background: rgba(124,109,250,0.18); border-color: rgba(124,109,250,0.4); }
.divider-v { width: 1px; background: var(--line); align-self: stretch; }
</style>