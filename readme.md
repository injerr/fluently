# Fluently CLI

<i>El mini framework creado por @injerr (Jeremy Intriago Pachay), Todos los derechos reservados.</i>

<h3>Comandos básicos:</h3>
<b>Iniciar el servidor</b><br>
php fluently serve --port=8000<br><br>
<b>Crear un controlador</b><br>
php fluently make->controller UserController<br><br>
<b>Crear un modelo</b><br>
php fluently make->model User<br><br>
<b>Crear una vista</b><br>
php fluently make->view ViewName<br>
<hr/>
<h3>Configuración</h3>
<b>El archivo .env sirve para configurar la base de datos:</b><br/>

DB_CONNECTION=mysql<br/>
DB_HOST=localhost<br/>
DB_NAME=tienda_db<br/>
DB_USER=root<br/>
DB_PASSWORD=<br/>

APP_NAME=Fluently
