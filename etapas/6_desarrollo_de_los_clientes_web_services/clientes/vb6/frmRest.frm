VERSION 5.00
Begin VB.Form frmRest 
   Caption         =   "REST"
   ClientHeight    =   3645
   ClientLeft      =   60
   ClientTop       =   390
   ClientWidth     =   5265
   LinkTopic       =   "Form1"
   ScaleHeight     =   3645
   ScaleWidth      =   5265
   StartUpPosition =   3  'Windows Default
   Begin VB.Frame frameSalas 
      Caption         =   "Salas"
      Height          =   2415
      Left            =   3480
      TabIndex        =   2
      Top             =   240
      Width           =   1575
      Begin VB.CommandButton cmdSalaBorrar 
         Caption         =   "Borrar"
         Height          =   375
         Left            =   360
         TabIndex        =   14
         Top             =   1920
         Width           =   855
      End
      Begin VB.CommandButton cmdSalaAgregar 
         Caption         =   "Agregar"
         Height          =   375
         Left            =   360
         TabIndex        =   13
         Top             =   960
         Width           =   855
      End
      Begin VB.CommandButton cmdSalaModificar 
         Caption         =   "Modificar"
         Height          =   375
         Left            =   360
         TabIndex        =   12
         Top             =   1440
         Width           =   855
      End
      Begin VB.CommandButton cmdSalaVer 
         Caption         =   "Ver"
         Height          =   375
         Left            =   360
         TabIndex        =   11
         Top             =   480
         Width           =   855
      End
   End
   Begin VB.Frame frameHabitaciones 
      Caption         =   "Habitaciones"
      Height          =   2415
      Left            =   1800
      TabIndex        =   1
      Top             =   240
      Width           =   1575
      Begin VB.CommandButton cmdHabBorrar 
         Caption         =   "Borrar"
         Height          =   375
         Left            =   360
         TabIndex        =   10
         Top             =   1920
         Width           =   855
      End
      Begin VB.CommandButton cmdHabAgregar 
         Caption         =   "Agregar"
         Height          =   375
         Left            =   360
         TabIndex        =   9
         Top             =   960
         Width           =   855
      End
      Begin VB.CommandButton cmdHabModificar 
         Caption         =   "Modificar"
         Height          =   375
         Left            =   360
         TabIndex        =   8
         Top             =   1440
         Width           =   855
      End
      Begin VB.CommandButton cmdHabVer 
         Caption         =   "Ver"
         Height          =   375
         Left            =   360
         TabIndex        =   7
         Top             =   480
         Width           =   855
      End
   End
   Begin VB.Frame frameCamas 
      Caption         =   "Camas"
      Height          =   3375
      Left            =   120
      TabIndex        =   0
      Top             =   240
      Width           =   1575
      Begin VB.CommandButton cmdCamasOcupar 
         Caption         =   "Ocupar"
         Height          =   375
         Left            =   360
         TabIndex        =   16
         Top             =   2880
         Width           =   855
      End
      Begin VB.CommandButton cmdCamasLiberar 
         Caption         =   "Liberar"
         Height          =   375
         Left            =   360
         TabIndex        =   15
         Top             =   2400
         Width           =   855
      End
      Begin VB.CommandButton cmdCamasBorrar 
         Caption         =   "Borrar"
         Height          =   375
         Left            =   360
         TabIndex        =   6
         Top             =   1920
         Width           =   855
      End
      Begin VB.CommandButton cmdCamasAgregar 
         Caption         =   "Agregar"
         Height          =   375
         Left            =   360
         TabIndex        =   5
         Top             =   960
         Width           =   855
      End
      Begin VB.CommandButton cmdCamasModificar 
         Caption         =   "Modificar"
         Height          =   375
         Left            =   360
         TabIndex        =   4
         Top             =   1440
         Width           =   855
      End
      Begin VB.CommandButton cmdCamasVer 
         Caption         =   "Ver"
         Height          =   375
         Left            =   360
         TabIndex        =   3
         Top             =   480
         Width           =   855
      End
   End
End
Attribute VB_Name = "frmRest"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Option Explicit


Private Sub cmdCamasAgregar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
        
    'URL
    sUrl = "http://192.168.56.1:8005/camas/nueva/292/tocoginecologia/hab1/t-hab1-cama3/1/L/false/false.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "POST", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdCamasBorrar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
            
    'URL
    sUrl = "http://192.168.56.1:8005/camas/eliminar/72/cama_no_existe.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "DELETE", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdCamasLiberar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
        
    'URL
    sUrl = "http://192.168.56.1:8005/camas/liberar/71/s1u-ua-4.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "PATCH", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdCamasModificar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
    
    'URL
    sUrl = "http://192.168.56.1:8005/camas/modificar/63/clinica medica/hab 5/cm-hab5-cama 2/5/L/false/false.json"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "PUT", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdCamasOcupar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
    
    'URL
    sUrl = "http://192.168.56.1:8005/camas/ocupar/71/s1u-ua-4.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "PATCH", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdCamasVer_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP

    'var
    Dim sUrl As String
    Dim sUser_basic As String
    Dim sPass_basic As String
    Dim sUser_ws As String
    Dim sPass_ws As String

    'URL
    sUrl = "https://twww.santafe.gob.ar/redinternacion/api/camas/ver/121/HD4.json"

    'credenciales
    sUser_basic = "everis_ws"
    sPass_basic = "b1f4c2f64c2cced32b4963e902c4ea2bba6f00397383c45165cb5e51ca94da0b"
    sUser_ws = "everis_ws"
    sPass_ws = "e099c96f5c6f39c498c810dc748bbc50"
        
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP

    'request sincrono
    xmlhttp.open "GET", sUrl, False, sUser_basic, sPass_basic
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.setRequestHeader "usuario", sUser_ws
    xmlhttp.setRequestHeader "password", sPass_ws
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.responseText, , sUrl
        
End Sub

Private Sub cmdHabAgregar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
    
    'URL
    sUrl = "http://192.168.56.1:8005/habitaciones/nueva/121/ucip/ucip/3/0/255/6/0.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "POST", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdHabBorrar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
        
    'URL
    sUrl = "http://192.168.56.1:8005/habitaciones/eliminar/5/sala- pediatria/hab de prueba.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "DELETE", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdHabModificar_Click()
    
    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
    
    'URL
    sUrl = "http://192.168.56.1:8005/habitaciones/modificar/72/obstetricia/anexo1/2/12/55/1/0.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "PUT", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdHabVer_Click()
    
    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
            
    'URL
    sUrl = "http://192.168.56.1:8005/habitaciones/ver/72/obstetricia/anexo.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "GET", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdSalaAgregar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
    
    'URL
    sUrl = "http://192.168.56.1:8005/salas/nueva/63/TRAUMATOLOGIA/null/null/null/false/false.json"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "POST", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdSalaBorrar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
        
    'URL
    sUrl = "http://192.168.56.1:8005/salas/eliminar/63/TRAUMATOLOGIA.json"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "DELETE", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdSalaModificar_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
    
    'URL
    sUrl = "http://192.168.56.1:8005/salas/modificar/167/emergencias/null/null/null/false/false.json"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "PUT", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
    
End Sub

Private Sub cmdSalaVer_Click()

    'Agregar la refencia Microsoft XML
    Dim xmlhttp As MSXML2.ServerXMLHTTP
    
    'var
    Dim sUrl As String
        
    'URL
    sUrl = "http://192.168.56.1:8005/salas/ver/292/medicina general mujeres.xml"
    
    'inicializa objeto http
    Set xmlhttp = New MSXML2.ServerXMLHTTP
    
    'request sincrono
    xmlhttp.open "GET", sUrl, False
    xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    xmlhttp.send
    
    'response
    MsgBox xmlhttp.responseText, , sUrl
    
End Sub
