// JavaScript Document

Ext.form.Field.prototype.msgTarget = 'side';


Ext.onReady(function(){

    Ext.QuickTips.init();
    var clock = new Ext.Toolbar.TextItem('');
    var date = new Date().format('l, d/F/Y');
    var tmp = new Date().format('G');
    var saludo;


    if (tmp <= 12)
        saludo = "Buenos dias"
    else
    if (tmp > 12 && tmp <= 18)
        saludo = "Buenos tardes"
    else
        saludo = "Buenos noches"

    var frmLogin = new Ext.FormPanel({
        //title:'Iniciar Sesi&oacute;n',
//        frame: true,
        layout:'form',
        width:'20%',
        iconCls:'key',
        style:'margin-top:10%; margin-left:36%',
        autoHeight:true,
        border:false,
        labelWidth:70,
        labelAlign:'right',
        items: [{
            xtype:'fieldset',
            layout:'form',
            anchor:'100%',
            border:false,
            autoHeight:true,
            items:[{
                xtype:'textfield',
                fieldLabel:'Usuario',
                id:'usuario',
                name:'usuario',
                anchor:'90%',
                value:'pedro', //momentaneo
                minLength:'2', //como minimo deven introducir 4 caracteres
                minLengthText:'Usted debe introducir al menos 4 caracteres',
                allowBlank:false,
                maskRe: new RegExp ('[a-z A-Z 0-9]')// Con esta mascara solo podr�n introducir letras y numeros
            },{
                xtype:'textfield',
                fieldLabel:'Contrase&ntilde;a',
                inputType:'password',
                id:'clave',
                name:'clave',
                value:'pedro', //momentaneo
                anchor:'90%',
                minLength:'2', //como minimo deven introducir 4 caracteres
                minLengthText:'Usted debe introducir al menos 4 caracteres',
                allowBlank:false,
                maskRe: new RegExp ('[a-z A-Z 0-9]'),// Con esta mascara solo podr�n introducir letras y numeros
                listeners:{
                    'specialkey': function(field, e){
                        if (e.getKey() == e.ENTER) {
                            frmLogin.validarAcceso();
                        }
                    }
                }
            }]
        },{
            buttonAlign:'center',
            border:false,
            buttons:[{
                text:'Conectar',
                id:'btnConectar',
                iconCls:'conectar',
                handler:function(){
                    //metodo para envio de validacion de la autentificacion del usuario.
                    frmLogin.validarAcceso();
                }
            }]
        }],

        validarAcceso: function(){
            if (this.getForm().isValid()) {
                this.getForm().submit({
                    url: '../php/conexion.php',
                    method: 'POST',
                    waitTitle: 'Conectando',
                    waitMsg: 'Validando acceso...',
                    success: function(form, action){
                        success = Ext.util.JSON.decode(action.response.responseText);
                        Ext.getCmp('nombre').setValue(success['nombreUsuario']);
                        var nombre = Ext.getCmp('nombre').getValue();
                        dsUsrPrivilegios.reloadDataSet(nombre);
                    },
                    failure: function(form, action){
                        if (action.failureType == 'server') {
                            var data = Ext.util.JSON.decode(action.response.responseText);
                            Ext.Msg.alert('Conexi&oacute;n Fallida', data.errors.reason);
                        }
                        else {
                            Ext.Msg.alert('Error!', 'El servidor de autenticacion es inalcanzable:'
                                + action.response.responseText);
                        }
                        frmLogin.getForm().reset();
                    }
                });
            }
            else {
                Ext.Msg.show({
                    title:'Error',
                    msg:'Por favor, introduzca nombre de usuario y contrase&ntilde;a',
                    icon:Ext.Msg.ERROR,
                    buttons: Ext.Msg.OK
                });
            }
        }
    }
    );

    var viewport = new Ext.Viewport({
        layout:'border',
        id:'view',
        hideBorders:true,
        items:[{
            region:'north',
            //frame:true,
            height:20,
            bodyStyle:'padding: 0 0%;',
            items:[{
                border:false,
                tbar: new Ext.Toolbar({
                    items: ['->',saludo,'-',clock, '-', date,' ']
                }),
                listeners: {
                    'render': function(){
                        //Ext.fly(clock.getEl().parentNode).addClass('x-status-text-panel');
                        Ext.TaskMgr.start({
                            run: function(){
                                Ext.fly(clock.getEl()).update(new Date().format('g:i:s A'));
                            },
                            interval: 1000
                        });
                    }
                }

            }]
        },{
            region:'center',
            hideBorders:true,
            bodyStyle:'background:url(../wallpapers/desktop.jpg);',
            frame:true,
            items:[{
                    bodyStyle:'background:url(../wallpapers/desktop.jpg);',
                items:[
                       frmLogin

                ]
            }]
        }]
    })
});

