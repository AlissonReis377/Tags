<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre o Tags</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style/stylehome.css">
    <link rel="stylesheet" href="css/animate.css">
    
    
    <!--Animações-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/gsap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/Draggable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/DrawSVGPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/EaselPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/Flip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/GSDevTools.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/InertiaPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/MotionPathHelper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/MotionPathPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/MorphSVGPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/Observer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/Physics2DPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/PhysicsPropsPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/PixiPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrambleTextPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollTrigger.min.js"></script>
    <!-- ScrollSmoother requires ScrollTrigger -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollSmoother.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollToPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/SplitText.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/TextPlugin.min.js"></script>

    <!-- RoughEase, ExpoScaleEase and SlowMo are all included in the EasePack file -->    
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/EasePack.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/CustomEase.min.js"></script>
    <!-- CustomBounce requires CustomEase -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/CustomBounce.min.js"></script>
    <!-- CustomWiggle requires CustomEase -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/CustomWiggle.min.js"></script>
</head>

<style>
.Horizontal {
  overflow: hidden;
  height: 100vh;
  display: flex;
  align-items: center;
}

.Horizontal__text {
  display: flex;
  width: max-content;
  white-space: nowrap;
  gap: 4vw;
  padding-left: 100vw;
}

.heading-xl {
  font-size: clamp(2rem, 10vw, 12rem);
  font-weight: 600;
  line-height: 1.1;
}
.hero-scroll {
  position: relative;
  height: 400vh; /* controla o tempo da animação */
  background: #000;
}

.hero-img {
  position: sticky;
  top: 0;
  width: 100%;
  height: 100vh;
  object-fit: cover;
  transform-origin: center;
  z-index: 1;
  border-radius:20px;
}

.hero-text {
  position: sticky;
  top: 40%;
  text-align: center;
  color: #000000;
  opacity: 0;
  z-index: 2;
  pointer-events: none;
}

.hero-text h1 {
  font-size: 3rem;
}

.navbar {
  transition: opacity 0.3s ease, transform 0.3s ease;
}
body {
  overflow-x: hidden;
}

.secao {
  min-height: 100vh;
  padding: 100px 10%;
  background: #fff;
  justify-content: center;
  justify-items: center;
}

.reveal,
.reveal-img {
  opacity: 0;
  transform: translateY(40px);
  justify-content: center;
  justify-items: center;
  
}

.reveal-img {
  width: 300px;
  display: block;
  margin: auto;
}

.intro-scroll {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.intro-text {
  font-size: 6vw;
  text-align: center;
}

.intro-image {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  padding-top: 100px;
}

.intro-image img {
  width: 400px;
  opacity: 0;
  transform: translateY(40px);
  transition: 0.6s ease;
}

.scroll-scene {
  height: 200vh;
  position: relative;
}

.scene-text {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(1);
  transform-origin: center center;
  font-size: 6vw;
  z-index: 2;
  opacity: 0;
  pointer-events: none;
}

.scene-img {
  position: absolute;
  bottom: -100vh;
  left: 50%;
  transform: translateX(-50%);
  width: 400px;
  z-index: 3;
}

.mobile{
  display: none;
}

@media (max-width: 767.98px){

  #Equipe{
    display: none;
  }

  .desktop{
    display: none;
  }
  .img-mobile {
    display: block;
  }
}


</style>
<script>
  AOS.init();
</script>
<body style="background-color: black;">
    
<nav class="navbar navbar-expand-lg navbar-glass">
    <div class="navbar-inner">

        <div class="d-flex align-items-center gap-2">
            <img src="imagens/tags.png" width="40">
        </div>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                </li>
                <li class="nav-item"><a class="nav-link" href="#sobre">Sobre o Projeto</a></li>
                <li class="nav-item"><a class="nav-link" href="#Equipe">Equipe TAGS</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php">Login</a></li>
            </ul>
        </div>
    </div>
</nav>


<!-- ================= PAGINA SOBRE O PROJETO/CONTEUDO PRINCIPAL ================= -->

<section id="sobre" class="about-section" style=" color: white; padding: 50px 0;">
    <div class="container about-page">
        <div class="row">
            <div class="col-lg-6">
                <div class="about_text tags_post">
                    <h1>O que é o TAGS?</h1>
                    <p>Tags é um projeto criado por estudantes de cursos de tecnologia para servir como uma rede social que conecta pessoas com mesmos interesses</p>
                </div>

                <div class="about_text tags_post">
                    <h1>Quem faz o TAGS?</h1>
                    <p>Nós somos membros da AVI, uma iniciativa que reune alunos de graduação na área de tecnologia de várias capacidades diferentes, somos um pequeno grupo de desenvolvedores, mas com uma capacidade incrivel</p>
                </div>

                <div class="about_text tags_post">
                    <h1>Como posso contribuir?</h1>
                    <p>Por enquanto a unica forma de contribuição que estamos aceitando é a participação dentro da rede social, testando e enviando bugs, sugestões, feebacks para o nosso email <a href="mailto:tags.contato@gmail.com">tags.contato@gmail.com</a></p>
                </div>
            </div>
            <div class="col-lg-6 desktop">
                <img src="imagens/tags.png">
            </div>
        
        </div>
    </div>
</section>


<!-- ================= SEÇÃO NOVIDADES ================= -->
<section id="novidades" class="novidades" style="background-color: #000000; justify-content: center; text-align: center; padding: 200px 0;">

<section class="Horizontal" style="background-color: #000;">
  <div class="container">
    <h3 class="Horizontal__text heading-xl" style="color: #fff;">
O novo TAGS está chegando e ele vai te impressionar!
    </h3>
  </div>
</section>

<section class="hero-scroll" style="padding-bottom: 600px">
  <img src="imagens/depois.png" class="hero-img desktop">
  <img src="imagens/novo-tags.png" class="hero-img mobile">

  <div class="hero-text">
    <h1>Uma nova interface</h1>
    <p>mais moderna e mais bonita</p>
  </div>

</section>
<section class="secao">
  <div class="reveal intro-text Poppins" style="font-size: 3rem; color: black; margin-bottom: 100px;">
    <h1>O novo é muuuuuuito melhor!</h1>
    <p>Em breve você poderá conhecer a modernidade</p>
  <div class="reveal-img intro-image">
    <img src="imagens/novo-tags.png" alt="Novidades TAGS">
  </div>
<script src="https://cdn.logwork.com/widget/countdown.js"></script>
<a href="https://logwork.com/countdown-timer" class="countdown-timer Poppins" data-timezone="Europe/London" data-date="2026-03-25 21:00" data-background="#ffffff" data-digitscolor="#000000" style="font-family: Poppins;">Tags 2</a>





</section>



<!-- ================= SEÇÃO EQUIPE TAGS ================= -->
<section id="Equipe" class="equipe_tags" style="padding: 200px;">
<h1 class="Poppins" style="text-align: center; margin-bottom: 100px; color: white;">Equipe TAGS</h1>
<div class="container">
<div class="row">
<!--=========Alisson=========-->
    <div class="col-lg-6 tags_post alisson">
        <h1>Alisson</h1>
        <p>Project leader, Full stack developer</p>
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Formado em Analise e desenvolvimento de sistemas

<br><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Estudante em Ciência da computação

<br><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Gerente de projeto e criador da iniciativa AVI</p>
    </div>

<div class="col-lg-6 foto">
    <img src="imagens/alisso.jpeg" class="rounded-circle" width="250" height="250" style="object-fit: cover;">
</div>
</div>
<!--=========Laura=========-->
    <div class="row mt-5">
    <div class="col-lg-6 foto">
        <img src="imagens/laura.jpeg" class="rounded-circle" width="250" height="250" style="object-fit: cover;">
    </div>
    <div class="col-lg-6 tags_post laura">
        <h1>Laura</h1>
        <p>Front-end Developer</p>
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Estudante de Analise e desenvolvimento de sistemas
<br><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Programadora Front-End (Javascript, HTML, CSS)</p>
    </div>
</div>
<!--=========Hyasmin=========-->
<div class="row mt-5">
    <div class="col-lg-6 tags_post Hyasmin">
        <h1>Hyasmin</h1>
        <p>Back-end Developer</p>
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Formada em Analise e desenvolvimento de sistemas
<br><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Profissional de Infraestrutura</p>
</div>

    <div class="col-lg-6 foto">
        <img src="imagens/hyas.jpeg" class="rounded-circle" width="250" height="250" style="object-fit: cover;">
    </div>

</div>
<!--=========Vitor=========-->
<div class="row mt-5">
    <div class="col-lg-6 foto">
        <img src="imagens/vitor.jpeg" class="rounded-circle" width="250" height="250" style="object-fit: cover;">
    </div>
    <div class="col-lg-6 tags_post vitor">
    <h1>Vitor</h1>
        <p>Leader Designer</p>
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Formado em Design Gráfico
<br><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>Especialista em UX/UI</p>
    </div>
</div>
</section>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="js/wow.min.js"></script>
<script>
  AOS.init();
  gsap.registerPlugin(SplitText, ScrollTrigger);

let wrapper = document.querySelector(".Horizontal");
let text = document.querySelector(".Horizontal__text");
let split = SplitText.create(".Horizontal__text", { type: "chars, words" });

const scrollTween = gsap.to(text, {
  xPercent: -100,
  ease: "none",
  scrollTrigger: {
    trigger: wrapper,
    pin: true,
    end: "+=5000px",
    scrub: true
  }
});

split.chars.forEach((char) => {
  gsap.from(char, {
    yPercent: "random(-200, 200)",
    rotation: "random(-20, 20)",
    ease: "back.out(1.2)",
    scrollTrigger: {
      trigger: char,
      containerAnimation: scrollTween,
      start: "left 100%",
      end: "left 30%",
      scrub: 1
    }
  });
});

gsap.registerPlugin(ScrollTrigger);

const tl = gsap.timeline({
  scrollTrigger: {
    trigger: ".hero-scroll",
    start: "top top",
    end: "bottom top",
    scrub: 1.5
  }
});

tl.to(".hero-img", {
  scale: 0.6,
  ease: "none"
});

tl.to(".hero-scroll", {
  backgroundColor: "#ffffff",
  ease: "none"
}, 0);

tl.to(".hero-text", {
  opacity: 1,
  y: 200,
  ease: "none"
}, 0.3);

gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.create({
  trigger: ".hero-scroll",
  start: "top top",
  end: "bottom top",

  onEnter: () => {
    gsap.to(".navbar", {
      opacity: 0,
      y: -20,
      pointerEvents: "none",
      duration: 0.3
    });
  },

  onLeave: () => {
    gsap.to(".navbar", {
      opacity: 1,
      y: 0,
      pointerEvents: "auto",
      duration: 0.3
    });
  },

  onEnterBack: () => {
    gsap.to(".navbar", {
      opacity: 0,
      y: -20,
      pointerEvents: "none",
      duration: 0.3
    });
  },

  onLeaveBack: () => {
    gsap.to(".navbar", {
      opacity: 1,
      y: 0,
      pointerEvents: "auto",
      duration: 0.3
    });
  }
});

gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray(".reveal, .reveal-img").forEach((el) => {
  gsap.to(el, {
    opacity: 1,
    y: 0,
    duration: 1,
    ease: "power2.out",
    scrollTrigger: {
      trigger: el,
      start: "top 80%",
      toggleActions: "play none none none"
    }
  });
});

  const sectionImg = document.querySelector('.intro-image');
  const img = sectionImg.querySelector('img');

  window.addEventListener('scroll', () => {
    const top = sectionImg.getBoundingClientRect().top;
    if (top < window.innerHeight - 100) {
      img.style.opacity = 1;
      img.style.transform = 'translateY(0)';
    }
  });


  gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.create({
  trigger: ".scroll-scene",
  start: "top top",
  end: "bottom top",
  pin: ".scene-text",
  pinSpacing: false
});

gsap.to(".scene-img", {
  y: "-150vh",
  ease: "none",
  scrollTrigger: {
    trigger: ".scroll-scene",
    start: "top top",
    end: "bottom top",
    scrub: true
  }
});

gsap.to(".scene-text", {
  opacity: 1,
  color: "#ffffff",
  scrollTrigger: {
    trigger: ".scroll-scene",
    start: "top center",
    end: "top top",
    scrub: true
  }
});
ScrollTrigger.create({
  trigger: ".scroll-scene",
  start: "top top",
  end: "bottom top",
  pin: ".scene-text",
  pinSpacing: false
});


</script>




</html>