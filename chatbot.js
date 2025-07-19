(function() {
  if (window.enebyChatbotLoaded) return;
  window.enebyChatbotLoaded = true;

  // --- CSS Eneby chatbot ---
  const style = document.createElement('style');
  style.innerHTML = `
    #eneby-bubble {
      position: fixed; bottom: 24px; right: 24px;
      width: 62px; height: 62px;
      background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
      border-radius: 50%;
      box-shadow: 0 6px 24px #3b82f680;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; z-index: 99999;
      border: 2.5px solid #fff;
      transition: box-shadow .14s, transform .12s;
    }
    #eneby-bubble:hover { box-shadow: 0 10px 32px #8b5cf6b0; transform: scale(1.07); }
    #eneby-bubble svg {
      width: 36px; height: 36px; display: block;
      background: none;
    }
    #eneby-chatbox {
      position: fixed; bottom: 40px; right: 40px;
      width: 410px; max-width: 99vw; height: 600px; min-height: 340px;
      background: rgba(25,30,54,0.98);
      border-radius: 20px; box-shadow: 0 10px 60px #8b5cf6a0;
      border: 1.5px solid #6366f1;
      display: none; flex-direction: column;
      z-index: 99999; font-family: 'Inter',sans-serif;
      animation: eneby-fade-scale-in .38s;
      will-change: opacity, transform;
    }
    @keyframes eneby-fade-scale-in {
      0% {opacity:0; transform:scale(0.92) translateY(36px);}
      100% {opacity:1; transform:scale(1) translateY(0);}
    }
    #eneby-chatbox.hide {
      animation: eneby-fade-scale-out .32s forwards;
      pointer-events: none;
    }
    @keyframes eneby-fade-scale-out {
      0% {opacity:1; transform:scale(1) translateY(0);}
      100% {opacity:0; transform:scale(0.92) translateY(36px);}
    }
    #eneby-messages[aria-live] { outline:none; }
    #eneby-chatbox-header {
      background: linear-gradient(90deg,#3b82f6 0%,#8b5cf6 100%);
      color: #fff; padding: 1.1rem 1.2rem; font-weight: 700;
      font-size: 1.15rem; display: flex; align-items: center; justify-content: space-between;
      border-radius: 20px 20px 0 0;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 8px #3b82f624;
    }
    #eneby-close { cursor:pointer; font-size:1.45rem; opacity:0.78; transition:.13s;}
    #eneby-close:hover { opacity:1; transform:scale(1.13);}
    #eneby-messages {
      flex: 1; padding: 1.1rem 1.1rem 0.2rem 1.1rem;
      overflow-y: auto; background: transparent;
      color: #e0e7ef; font-size: 1.01rem; display: flex; flex-direction: column;
      gap: 0.6em;
    }
    .eneby-msg-bot, .eneby-msg-user {
      max-width: 85%; padding: 0.65em 1.1em;
      border-radius: 17px;
      margin-bottom: 3px; word-break: break-word; line-height: 1.45;
      box-shadow: 0 2px 16px #2321442a, 0 1.5px 9px #23214417;
      position: relative;
      display: inline-block;
    }
    .eneby-msg-bot {
      background: linear-gradient(90deg,#353e6c 30%,#2a2855 100%);
      align-self: flex-start; color: #b8b2fa;
      border-bottom-left-radius: 3px;
    }
    .eneby-msg-user {
      background: linear-gradient(90deg,#3b82f6 0%,#8b5cf6 100%);
      align-self: flex-end; color: #fff;
      border-bottom-right-radius: 3px;
      margin-left: auto;
    }
    #eneby-input-bar {
      display:flex; gap: .6rem; padding: 0.7rem 0.7rem;
      background: rgba(36,41,69,0.99);
      border-top: 1px solid #3b82f6;
      border-radius: 0 0 18px 18px;
      align-items: center;
    }
    #eneby-userinput {
      flex:1; border-radius:12px; border:1.7px solid #6366f1;
      padding:0.68rem 1rem; outline:none; background:#171a31; color:#fff;
      font-size:1.04rem;
      min-width:0; max-width:100%;
    }
    #eneby-userinput:focus { border-color: #8b5cf6; background: #181c38;}
    #eneby-input-bar button {
      min-width: 48px;
      max-width: 52px;
      aspect-ratio: 1/1;
      border-radius: 50%;
      background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
      box-shadow: 0 2px 12px #8b5cf680;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: box-shadow .16s, transform .13s, background .18s;
      cursor: pointer;
      font-size: 1.18em;
      color: #fff;
      outline: none;
      margin-left: 0.2em;
      padding: 0.62rem 0.9rem;
    }
    #eneby-input-bar button span { display:none; }
    #eneby-input-bar button .eneby-plane {
      margin-left:0;
      width: 22px;
      height: 22px;
      fill: #fff;
      display: block;
      transition: transform .18s;
    }
    #eneby-input-bar button:hover .eneby-plane {
      transform: translateY(-2px) scale(1.12) rotate(-8deg);
      filter: drop-shadow(0 0 6px #8b5cf6);
    }
    #eneby-input-bar button:active { transform:scale(0.93); }
    #eneby-input-bar button:hover, #eneby-input-bar button:focus {
      box-shadow: 0 4px 18px #6366f1b0;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      transform: scale(1.07);
    }
    #eneby-faq-bubbles {
      display:flex; flex-wrap:wrap; gap:0.3em; margin:8px 0 0 0;
      justify-content: flex-start;
    }
    .eneby-faq-bubble {
      font-size:0.97em; min-width:unset; max-width: 48vw;
      padding:6px 13px; border-radius:13px;
      margin:2px 0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
    }
    @media (max-width:700px) {
      #eneby-chatbox { width: 98vw; right:1vw; left:1vw; min-width:0; height: 97vw; min-height:320px; }
      .eneby-faq-bubble { font-size:0.95em; max-width: 70vw; padding:5px 10px; }
    }
    #eneby-messages::-webkit-scrollbar {width:6px;}
    #eneby-messages::-webkit-scrollbar-thumb {background:#6366f1; border-radius:4px;}
    #eneby-faq-bubbles {
      display:flex; flex-wrap:wrap; gap:0.5em; margin:10px 0 0 0;
    }
    .eneby-faq-bubble {
      background:linear-gradient(90deg,#3b82f6,#8b5cf6);color:#fff;
      padding:8px 18px;border-radius:16px;border:none;margin:2px 0;cursor:pointer;
      font-size:1em; box-shadow:0 1px 7px #6366f14a;transition:.14s;
      outline:none;
    }
    .eneby-faq-bubble:hover { background:linear-gradient(90deg,#6366f1,#3b82f6);}
    .eneby-msg-bot.pulse {
      animation: eneby-pulse 1.2s 1;
    }
    @keyframes eneby-pulse {
      0% {box-shadow:0 0 0 0 #6366f1a0;}
      70% {box-shadow:0 0 0 12px #6366f100;}
      100% {box-shadow:0 0 0 0 #6366f100;}
    }
    .eneby-faq-bubble:focus {
      outline: 2.5px solid #fff;
      box-shadow: 0 0 0 3px #8b5cf6, 0 2px 8px #6366f1a0;
      background:linear-gradient(90deg,#6366f1,#3b82f6);
    }
  `;
  document.head.appendChild(style);

  // --- HTML structure Eneby chatbot ---
  const root = document.createElement('div');
  root.id = 'eneby-chatbot-widget';
  root.innerHTML = `
    <div id="eneby-bubble" title="Chat avec nous">
      <svg viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
        <circle cx="20" cy="20" r="18" fill="none"/>
        <path d="M20 10c-6.5 0-11.5 4-11.5 9 0 2.4 1.3 4.7 3.5 6.3-.1.9-.7 2.6-1.1 3.6-.1.3.2.6.5.4 1.5-.7 3.2-1.5 3.9-1.9C17.1 28.1 18.5 28.5 20 28.5c6.5 0 11.5-4 11.5-9S26.5 10 20 10z" fill="#fff"/>
        <circle cx="16" cy="19" r="1.1" fill="#8b5cf6"/>
        <circle cx="20" cy="19" r="1.1" fill="#8b5cf6"/>
        <circle cx="24" cy="19" r="1.1" fill="#8b5cf6"/>
      </svg>
    </div>
    <div id="eneby-chatbox" aria-modal="true" role="dialog">
      <div id="eneby-chatbox-header">
        <span>
          <svg viewBox="0 0 40 40" style="vertical-align:middle;width:25px;height:25px;display:inline-block;" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="18" fill="none"/>
            <path d="M20 10c-6.5 0-11.5 4-11.5 9 0 2.4 1.3 4.7 3.5 6.3-.1.9-.7 2.6-1.1 3.6-.1.3.2.6.5.4 1.5-.7 3.2-1.5 3.9-1.9C17.1 28.1 18.5 28.5 20 28.5c6.5 0 11.5-4 11.5-9S26.5 10 20 10z" fill="#fff"/>
            <circle cx="16" cy="19" r="1.1" fill="#8b5cf6"/>
            <circle cx="20" cy="19" r="1.1" fill="#8b5cf6"/>
            <circle cx="24" cy="19" r="1.1" fill="#8b5cf6"/>
          </svg>
          Eneby Chat
        </span>
        <span id="eneby-close" title="Fermer">&times;</span>
      </div>
      <div id="eneby-messages" aria-live="polite" tabindex="0">
        <div class="eneby-msg-bot pulse">
          👋 Bonjour ! Je suis Eneby Chat, votre assistant.<br>
          Comment puis-je vous aider aujourd'hui ?<br>
          <span style="color:#a5b4fc;">Exemples : horaires, contact, rendez-vous, tarifs…</span>
        </div>
      </div>
      <div id="eneby-faq-bubbles"></div>
      <form id="eneby-input-bar" autocomplete="off">
        <input type="text" id="eneby-userinput" placeholder="Votre question…" autocomplete="off" />
        <button type="submit"><svg class="eneby-plane" viewBox="0 0 20 20"><path d="M2 10l15-6-6 15-2-6-6-2z"/></svg></button>
      </form>
    </div>
  `;
  document.body.appendChild(root);

  // --- Variables et éléments
  const bubble = document.getElementById('eneby-bubble');
  const chatbox = document.getElementById('eneby-chatbox');
  const close = document.getElementById('eneby-close');
  const messages = document.getElementById('eneby-messages');
  const form = document.getElementById('eneby-input-bar');
  const input = document.getElementById('eneby-userinput');
  const bubblesBox = document.getElementById('eneby-faq-bubbles');

  // --- Affichage & ouverture/fermeture
  bubble.onclick = () => {
    chatbox.classList.remove('hide');
    chatbox.style.display = 'flex';
    bubble.style.display = 'none';
    setTimeout(()=>input.focus(), 120);
  }
  close.onclick = () => {
    chatbox.classList.add('hide');
    setTimeout(()=>{
      chatbox.style.display = 'none';
      bubble.style.display = 'flex';
    }, 300);
  }

  // --- FAQ riche (beaucoup plus de questions et suggestions)
  const FAQ = [
    {
      questions: ["horaire", "heures", "ouvert", "fermé", "ouverture", "fermeture", "quand", "planning"],
      answer: "🕒 Nos horaires sont du lundi au vendredi de 9h à 18h.<br>Besoin d’un rendez-vous en dehors ? Contactez-nous !",
      suggest: ["Téléphone", "Adresse", "Prendre rendez-vous"]
    },
    {
      questions: ["téléphone", "appel", "numéro", "joindre", "contacter", "appeler"],
      answer: "📞 Appelez-nous au <b>01 23 45 67 89</b>.<br>Vous pouvez aussi nous écrire un mail.",
      suggest: ["Horaires", "Adresse", "Mail"]
    },
    {
      questions: ["adresse", "où", "localisation", "situé", "trouver", "venir", "plan"],
      answer: "📍 Nous sommes situés au <b>10 rue des Artisans, 75000 Paris</b>.",
      suggest: ["Téléphone", "Horaires", "Parking"]
    },
    {
      questions: ["mail", "email", "courriel", "écrire"],
      answer: "📧 Notre email : <b>contact@nab.fr</b>.<br>Nous répondons rapidement.",
      suggest: ["Téléphone", "Adresse", "Rendez-vous"]
    },
    {
      questions: ["rendez-vous", "rdv", "prendre rendez-vous", "réserver", "réservation"],
      answer: "📅 Pour prendre rendez-vous, appelez-nous ou envoyez un message avec vos disponibilités.",
      suggest: ["Horaires", "Tarifs", "Services"]
    },
    {
      questions: ["service", "prestations", "proposez", "quoi", "activité", "offres", "domaines"],
      answer: "🛠️ Voici nos services principaux :<ul style='margin:5px 0 0 1em; color:#a5b4fc;'><li>• Installation</li><li>• Conseil</li><li>• Maintenance</li></ul>Demandez-nous pour plus de détails !",
      suggest: ["Tarifs", "Prendre rendez-vous", "Horaires"]
    },
    {
      questions: ["tarif", "prix", "coût", "combien", "devis"],
      answer: "💶 Pour un devis personnalisé, merci de nous contacter via le formulaire ou par téléphone.",
      suggest: ["Services", "Prendre rendez-vous", "Adresse"]
    },
    {
      questions: ["parking", "se garer", "stationnement"],
      answer: "🅿️ Un parking public est disponible à proximité immédiate de nos locaux.",
      suggest: ["Adresse", "Horaires", "Contact"]
    },
    {
      questions: ["merci", "merci!", "merci beaucoup", "super"],
      answer: "Avec plaisir ! 😊<br>Besoin d’autre chose ?",
      suggest: ["Horaires", "Prendre rendez-vous", "Services"]
    },
    {
      questions: ["site web", "internet", "web", "en ligne"],
      answer: "🌐 Notre site internet est : <b>https://nab.fr</b><br>Toutes les infos y sont aussi.",
      suggest: ["Contact", "Adresse", "Services"]
    }
  ];

  const defaultSuggestions = ["Horaires", "Téléphone", "Adresse", "Services", "Prendre rendez-vous", "Tarifs"];

  // --- Loader animé (points) ---
  function showLoader() {
    const loader = document.createElement("div");
    loader.className = "eneby-msg-bot eneby-loader";
    loader.innerHTML = '<span class="eneby-dots"><span>.</span><span>.</span><span>.</span></span>';
    messages.appendChild(loader);
    messages.scrollTop = messages.scrollHeight;
    return loader;
  }

  // --- Message display avec animation et effet typing bot
  function scrollToBottom() {
    messages.scrollTo({ top: messages.scrollHeight, behavior: 'smooth' });
  }
  function addMsg(txt, from="bot", withLoader) {
    const el = document.createElement("div");
    el.className = from === "bot" ? "eneby-msg-bot" : "eneby-msg-user";
    el.style.opacity = 0;
    el.style.transform = "translateY(16px)";
    if (from === "bot" && (txt.length > 40 || withLoader)) {
      // Loader animé
      el.innerHTML = '<span id="eneby-loader"><span class="eneby-dot"></span><span class="eneby-dot"></span><span class="eneby-dot"></span></span>';
      messages.appendChild(el);
      scrollToBottom();
      setTimeout(()=>{
        let i = 0;
        el.innerHTML = '';
        const typing = setInterval(() => {
          el.innerHTML = txt.slice(0, i) + '<span class="eneby-typing">|</span>';
          i++;
          scrollToBottom();
          if (i > txt.length) {
            clearInterval(typing);
            el.innerHTML = txt;
            el.classList.add('pulse');
            scrollToBottom();
          }
        }, 12 + Math.random()*30);
      }, 600);
    } else if (from === "bot") {
      // Loader court même pour réponses brèves
      el.innerHTML = '<span id="eneby-loader"><span class="eneby-dot"></span><span class="eneby-dot"></span><span class="eneby-dot"></span></span>';
      messages.appendChild(el);
      scrollToBottom();
      setTimeout(()=>{
        el.innerHTML = txt;
        el.classList.add('pulse');
        scrollToBottom();
      }, 600);
    } else {
      el.innerHTML = txt;
      messages.appendChild(el);
      scrollToBottom();
    }
    setTimeout(()=>{
      el.style.transition = "opacity .32s, transform .32s";
      el.style.opacity = 1;
      el.style.transform = "translateY(0)";
      scrollToBottom();
    }, 30);
  }

  // --- Affiche les bulles suggestions (accessibilité tabIndex)
  function showSuggestions(suggestions) {
    bubblesBox.innerHTML = '';
    (suggestions || defaultSuggestions).forEach((sug, idx) => {
      const bubble = document.createElement('button');
      bubble.className = "eneby-faq-bubble";
      bubble.innerText = sug;
      bubble.tabIndex = 0;
      bubble.onclick = () => {
        input.value = sug;
        form.dispatchEvent(new Event('submit'));
      };
      bubble.onkeydown = e => {
        if (e.key === 'Enter' || e.key === ' ') bubble.click();
        if (e.key === 'ArrowRight') {
          const next = bubble.nextElementSibling; if (next) next.focus();
        }
        if (e.key === 'ArrowLeft') {
          const prev = bubble.previousElementSibling; if (prev) prev.focus();
        }
      };
      bubblesBox.appendChild(bubble);
    });
  }

  // --- Suggestion automatique après 10s d'inactivité
  let suggestTimeout;
  function resetSuggestTimeout() {
    if (suggestTimeout) clearTimeout(suggestTimeout);
    suggestTimeout = setTimeout(() => {
      const first = bubblesBox.querySelector('button');
      if (first) first.focus();
    }, 10000);
  }

  // --- Envoie utilisateur
  form.onsubmit = e => {
    e.preventDefault();
    const val = input.value.trim();
    if (!val) return;
    const btn = form.querySelector('button');
    btn.classList.add('sending');
    setTimeout(()=>btn.classList.remove('sending'), 420);
    addMsg(val, "user");
    input.value = "";
    resetSuggestTimeout();
    setTimeout(()=>{
      let found = false;
      const question = val.toLowerCase();
      for (const faq of FAQ) {
        if (faq.questions.some(q => question.includes(q))) {
          addMsg(faq.answer, "bot", true);
          showSuggestions(faq.suggest);
          found = true; break;
        }
      }
      if (!found) {
        addMsg("🤖 Je n’ai pas compris… Essayez d’autres mots-clés, ou contactez-nous !", "bot", true);
        showSuggestions(defaultSuggestions);
      }
      resetSuggestTimeout();
    }, 380);
  };

  // --- Ouvre avec suggestions par défaut
  showSuggestions(defaultSuggestions);
  resetSuggestTimeout();

  // --- Focus auto sur input à l'ouverture
  bubble.onclick = () => {
    chatbox.classList.remove('hide');
    chatbox.style.display = 'flex';
    bubble.style.display = 'none';
    setTimeout(()=>input.focus(), 120);
  }
  close.onclick = () => {
    chatbox.classList.add('hide');
    setTimeout(()=>{ chatbox.style.display = 'none'; bubble.style.display = 'flex'; }, 300);
  }

  // --- Message de bienvenue plus vivant
  messages.innerHTML = `<div class="eneby-msg-bot" style="background:linear-gradient(90deg,#6366f1 30%,#8b5cf6 100%);color:#fff;font-weight:600;box-shadow:0 2px 16px #6366f14a;">👋 Bienvenue sur Eneby Chat !<br>Posez-moi vos questions ou choisissez une suggestion.<br><span style='color:#a5b4fc;'>Exemples : horaires, contact, rendez-vous, tarifs…</span></div>`;

  // --- Amélioration bouton envoi (icône avion, feedback)
  document.querySelector('#eneby-input-bar button').innerHTML = '<svg class="eneby-plane" viewBox="0 0 20 20"><path d="M2 10l15-6-6 15-2-6-6-2z"/></svg>';
  document.querySelector('#eneby-input-bar button').onmousedown = e => { e.target.style.transform = 'scale(0.96)'; };
  document.querySelector('#eneby-input-bar button').onmouseup = e => { e.target.style.transform = ''; };

  // --- Ombre bulles plus marquée
  const style2 = document.createElement('style');
  style2.innerHTML = `.eneby-msg-bot, .eneby-msg-user { box-shadow: 0 2px 16px #6366f14a !important; } .eneby-loader .eneby-dots span { animation: eneby-dot 1.1s infinite; opacity:0.7; font-size:1.5em; margin:0 1px; } .eneby-loader .eneby-dots span:nth-child(2) { animation-delay: .2s; } .eneby-loader .eneby-dots span:nth-child(3) { animation-delay: .4s; } @keyframes eneby-dot { 0%,80%,100%{opacity:.3;} 40%{opacity:1;} }`;
  document.head.appendChild(style2);

  // --- Focus sur le champ de saisie après ouverture
  setTimeout(()=>{ if (chatbox.style.display === 'flex') input.focus(); }, 600);

})();