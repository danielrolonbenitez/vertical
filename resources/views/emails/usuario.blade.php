<!--<h1> alta de usuario</h1>-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/vertical.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/filter.css') }}" />
</head>

<body bgcolor="#f6f8f1">
<table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td>
    <!--[if (gte mso 9)|(IE)]>
      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
    <![endif]-->     
    <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td bgcolor="#08065f" class="header">
          <table width="50" align="left" border="0" cellpadding="0" cellspacing="0">  
            <tr>
              <td height="50" style="padding: 0 20px 20px 0;">
                <img class="fix" src="{{ URL::asset('images/logos/icono2.png') }}" width="70" height="70" border="0" alt="" />
              </td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
            <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td>
          <![endif]-->
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="width: auto; max-width: 300px;">  
            <tr>
              <td height="70">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="padding: 5px 0 0 0;">
                      	<span style="font-size: 28px; color: #e7e7e7;">Vertical</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table>
                  <tr>
                    <td style="padding: 0 0 0 3px;">
                      <span style="font-size: 22px; color: #e7e7e7;">Todo en un solo sitio.</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
      <tr>
        <td class="innerpadding borderbottom">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <p style="font-size: 14px;">Bienvenidos a vertical</p>
              </td>
            </tr>
            <tr>
              <td>
              	<p style="font-size: 14px;">Uds a sido dado de alta</p>
                <!--<p style="font-size: 14px;">Usted a solicitado el cambio de contraseña a Vertical, pulsando en el siguiente boton podrá completar una serie de datos para poder realizar el cambio solicitado.</p>-->
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td class="innerpadding borderbottom">
          <table width="115" align="left" border="0" cellpadding="0" cellspacing="0">  
            <tr>
              <td height="115" style="padding: 0 20px 20px 0;">
                <img class="fix" src="{{ URL::asset('images/candado.jpg') }}" width="115" height="115" border="0" alt="" />
              </td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
            <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td>
          <![endif]-->
          <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 380px;">  
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="bodycopy">
                        <p style="font-size: 14px;">
Estimado Usuario,<br>
<br>
Usted ha sido dado de alta en el sistema Vertical.<br>
<br>
<strong>Nombre:</strong> {{$user->nombre}}<br>
<strong>Apellido:</strong> {{$user->apellido}}<br>
<strong>Email:</strong> {{$user->email}}<br>
<strong>Rol:</strong> {{$rol->nombre}}<br>
<strong>Contrasela:</strong> {{$pass}}<br>
<br>
Para mas información ingrese al sistema.
                        </p>
                    </td>
                  </tr>
                  <!--<tr>
                    <td style="padding: 20px 0 5px 0;">
                      <table class="buttonwrapper" bgcolor="#08065f" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="button" height="45" style="text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;">
                            <p>hola</p><a href="{{ url('') }}" style="text-decoration:none;">Ingresar</a>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>-->
                </table>
              </td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
      <tr>
        <td class="footer" bgcolor="#44525f">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="color: #fff; font-size:12px;">
            <tr>
              <td align="center" style="padding: 5px 0 0 0;">
                <p>&reg; Vertical, Copyright 2015</p>
              </td>
            </tr>
            <tr>
              <td align="center" style="padding: 5px 0 0 0;">
                <p>Teléfono: 5432-8899</p>
              </td>
            </tr>
            <tr>
              <td align="center" style="padding: 5px 0 0 0;">
                <p>Celular: (011)15-6279-1583</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <!--[if (gte mso 9)|(IE)]>
          </td>
        </tr>
    </table>
    <![endif]-->
    </td>
  </tr>
</table>

<!--analytics-->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://tutsplus.github.io/github-analytics/ga-tracking.min.js"></script>
</body>

</html>