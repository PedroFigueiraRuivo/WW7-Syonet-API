<img src="https://user-images.githubusercontent.com/93988164/150440511-d018f611-b65d-4f4f-9367-189b3669c4b2.jpg">
<h1>WW7 - Syonet API</h1>
<div>
  <img src="https://img.shields.io/badge/Status-Finalizando-blueviolet">
  <img src="https://img.shields.io/badge/Versão-1.0-blue">
  <a href="https://br.wordpress.org/plugins/contact-form-7/"><img src="https://img.shields.io/badge/Dependência-Plugin_contact_form_7-orange"></a>
</div>
<br/>
<p>Plugin responsável por criar uma cópia dos dados do formulário digitados pelo usuário e enviar para o sistema de captura de leads Syonet.</p>

<h2>Funcionalidades do projeto</h2>

<p><code>Funcionalidade 1</code>: <span>Painel administrativo com campos para configurar os dados sensíveis;</span></p>
<p><code>Funcionalidade 2</code>: <span>Consumo de Shortcode.</span></p>

<h2>Acesso ao Projeto</h2>
<p>Os arquivos podem ser baixados diretamente desse repositório em "code&gtDownload ZIP" e um arquivo .zip será baixado para a sua máquina.</p>

<h3>Configurando o ambiente</h3>
<p>Com o download feito, basta descompactar o arquivo no diretório de plugins do wordpress e renomear a pasta para: <code>ww7-syonet-api</code>. Após isso, vá para o painel de plugins e ative o plugin. Com o plugin ativado, será criado um novo menu de administração nomeado como "WW7 - Syonet API".</p>

<p>Nessa aba estarão disponíveis 8 (oito) campos para configurar a integração com o sistema. Lembrando que <b>o valor dos campos é único e disponibilizado apenas pela empresa e não será abordado nessa documentação</b>.</p>

<p>Com o devido preenchimento dos campos, basta clicar em "Submit" e os dados serão setados no Banco de dados do WordPress.</p>

<p>Depois de configurar os dados de integração corretamente, você deverá acessar o painel do plugin contact form 7 no menu "contato&gtFormulários de contato", criar um novo formulário, nomea-lo como "WW7 - Syonet API" para a fácil identificação e, adicionar os seguintes campos com as segintes ID's:</p>

<blockquote>
  &lt div id="ww7syonetapi_name" &gt <br/>
    &lt label &gt Seu nome [text* nome] &lt /label &gt <br/>
&lt /div &gt <br/>
<br/>
&lt div id="ww7syonetapi_ddd" &gt <br/>
    &lt label &gt DDD [number* ddd min:10 max:98] &lt /label &gt <br/>
&lt /div &gt <br/>
<br/>
&lt div id="ww7syonetapi_cellphone" &gt <br/>
    &lt label &gt Celular [tel* celular] &lt /label &gt <br/>
&lt /div &gt <br/>
<br/>
&lt div id="ww7syonetapi_vehicle" &gt <br/>
    &lt label &gt Veículo de interesse [select* modelo include_blank "modelo1" "modelo2" "modelo3" "modelo4" "modelo5" "modelo..." "modeloN"] &lt /label &gt <br/>
&lt /div &gt <br/>
<br/>
&lt div id="ww7syonetapi_city" &gt <br/>
    &lt label &gt Cidade [select* cidade include_blank "Cidade1" "Cidade2", "Cidade...", "CidadeN"] &lt /label &gt <br/>
&lt /div &gt <br/>
<br/>
&lt div id="ww7syonetapi_message" &gt <br/>
    &lt label &gt Observação [textarea observacao] &lt /label &gt <br/>
&lt /div &gt <br/>
<br/>
&lt div id="ww7syonetapi_submit" &gt <br/>
[submit "Enviar"]
&lt /div &gt <br/>
</blockquote>

<p>Feito isso, salve o formulário.</p>

<h3>Formas de uso</h3>
<p>Para utilizar o plugin, basta que você cole o shortcode do Contact Form 7 onde desejar em sua página e, <strong>abaixo dele</strong>, você deverá colar o shortcode do plugin WW7 Syonet API específico para o Contact Form 7: <code>[ww7-syonet-api form="C7"]</code>.</p>


<h2>Tecnologias utilizadas</h2>
<ul>
  <li><code>PHP</code></li>
  <li><code>WordPress</code></li>
  <li><code>JavaScript</code></li>
</ul>


<h2>Desenvolvedores</h2>
<div>
<a href="https://github.com/PedroFigueiraRuivo"><img width="100px" src="https://avatars.githubusercontent.com/u/93988164?v=4"></a>
<p>Pedro Figueira</p>
</div>



<p></p>
