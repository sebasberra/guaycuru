<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Internaciones
 *
 * @ORM\Table(name="internaciones", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_periodo_informe_nro_informe", columns={"periodo_informe", "nro_informe"}), @ORM\UniqueConstraint(name="idx_unique_ing_hc_sies", columns={"ing_hc_sies"})}, indexes={@ORM\Index(name="fk_id_efector", columns={"id_efector"}), @ORM\Index(name="fk_id_efector_derivado_de", columns={"deriv1_id_efector"}), @ORM\Index(name="fk_id_efector_derivado_a", columns={"deriv2_id_efector"}), @ORM\Index(name="fk_id_localidad", columns={"id_localidad"}), @ORM\Index(name="fk_diag_presuntivo_id_ciex_4", columns={"diag_presuntivo_id_ciex_4"}), @ORM\Index(name="fk_causa_ext_id_ciex_4", columns={"causa_ext_id_ciex_4"}), @ORM\Index(name="idx_apellido", columns={"apellido"}), @ORM\Index(name="idx_nombre", columns={"nombre"}), @ORM\Index(name="idx_ing_fecha_hora", columns={"ing_fecha_hora"}), @ORM\Index(name="idx_egr_fecha_hora", columns={"egr_fecha_hora"}), @ORM\Index(name="idx_esp_pred_cod_servicio", columns={"esp_pred_cod_servicio"}), @ORM\Index(name="idx_backup_nro_doc", columns={"backup_nro_doc", "backup_id_tipo_doc"}), @ORM\Index(name="idx_id_persona", columns={"id_persona"}), @ORM\Index(name="idx_egr_id_servicio_estadistica", columns={"egr_id_servicio_estadistica"}), @ORM\Index(name="idx_ing_id_servicio_estadistica", columns={"ing_id_servicio_estadistica"}), @ORM\Index(name="idx_nro_informe", columns={"nro_informe"}), @ORM\Index(name="idx_os_rnos", columns={"os_rnos"}), @ORM\Index(name="idx_diag_presuntivo_texto", columns={"diag_presuntivo_texto"}), @ORM\Index(name="idx_diag_principal_texto", columns={"diag_principal_texto"}), @ORM\Index(name="idx_causa_ext_descripcion", columns={"causa_ext_descripcion"}), @ORM\Index(name="idx_id_paciente", columns={"id_paciente"})})
 * @ORM\Entity
 */
class Internaciones
{
    /**
     * @var string
     *
     * @ORM\Column(name="periodo_informe", type="string", length=4, nullable=false)
     */
    private $periodoInforme;

    /**
     * @var integer
     *
     * @ORM\Column(name="nro_informe", type="integer", nullable=false)
     */
    private $nroInforme;

    /**
     * @var string
     *
     * @ORM\Column(name="claveestd", type="string", length=8, nullable=false)
     */
    private $claveestd;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_efector", type="string", length=255, nullable=false)
     */
    private $nomEfector;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_dpto", type="string", length=3, nullable=false)
     */
    private $codDpto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nodo", type="boolean", nullable=false)
     */
    private $nodo;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_dep_adm", type="string", length=1, nullable=false)
     */
    private $codDepAdm;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_paciente", type="integer", nullable=false)
     */
    private $idPaciente;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_persona", type="integer", nullable=true)
     */
    private $idPersona;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_calle", type="string", length=255, nullable=false)
     */
    private $domCalle;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_nro", type="string", length=20, nullable=false)
     */
    private $domNro;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_piso", type="string", length=10, nullable=true)
     */
    private $domPiso;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_dpto", type="string", length=10, nullable=true)
     */
    private $domDpto;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_telefono", type="string", length=80, nullable=true)
     */
    private $domTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_barrio", type="string", length=255, nullable=true)
     */
    private $domBarrio;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_cod_loc", type="string", length=2, nullable=false)
     */
    private $domCodLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_cod_dpto", type="string", length=3, nullable=false)
     */
    private $domCodDpto;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_cod_prov", type="string", length=2, nullable=false)
     */
    private $domCodProv;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_cod_pais", type="string", length=3, nullable=false)
     */
    private $domCodPais;

    /**
     * @var string
     *
     * @ORM\Column(name="os_asociado_a", type="string", length=1, nullable=false)
     */
    private $osAsociadoA;

    /**
     * @var string
     *
     * @ORM\Column(name="os_nombre", type="string", length=255, nullable=true)
     */
    private $osNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="os_rnos", type="string", length=6, nullable=true)
     */
    private $osRnos;

    /**
     * @var string
     *
     * @ORM\Column(name="os_condicion", type="string", length=1, nullable=true)
     */
    private $osCondicion;

    /**
     * @var string
     *
     * @ORM\Column(name="situacion_laboral", type="string", length=1, nullable=false)
     */
    private $situacionLaboral;

    /**
     * @var string
     *
     * @ORM\Column(name="instruccion", type="string", length=2, nullable=false)
     */
    private $instruccion;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion_habitual", type="string", length=5, nullable=false)
     */
    private $ocupacionHabitual;

    /**
     * @var string
     *
     * @ORM\Column(name="ing_hospitalizado_por", type="string", length=1, nullable=false)
     */
    private $ingHospitalizadoPor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ing_fecha_hora", type="datetime", nullable=false)
     */
    private $ingFechaHora;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ing_edad", type="boolean", nullable=false)
     */
    private $ingEdad;

    /**
     * @var string
     *
     * @ORM\Column(name="ing_tipo_edad", type="string", length=1, nullable=false)
     */
    private $ingTipoEdad;

    /**
     * @var string
     *
     * @ORM\Column(name="ing_medio_traslado", type="string", length=1, nullable=true)
     */
    private $ingMedioTraslado;

    /**
     * @var string
     *
     * @ORM\Column(name="ing_cod_servicio", type="string", length=3, nullable=false)
     */
    private $ingCodServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="ing_sector", type="string", length=1, nullable=false)
     */
    private $ingSector;

    /**
     * @var string
     *
     * @ORM\Column(name="ing_subsector", type="string", length=1, nullable=false)
     */
    private $ingSubsector;

    /**
     * @var integer
     *
     * @ORM\Column(name="ing_medico_idperson", type="integer", nullable=true)
     */
    private $ingMedicoIdperson;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ing_derivado", type="boolean", nullable=false)
     */
    private $ingDerivado;

    /**
     * @var string
     *
     * @ORM\Column(name="ing_hc_sies", type="string", length=20, nullable=true)
     */
    private $ingHcSies;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ing_judicial", type="boolean", nullable=false)
     */
    private $ingJudicial;

    /**
     * @var string
     *
     * @ORM\Column(name="ing_judicial_observacion", type="string", length=255, nullable=true)
     */
    private $ingJudicialObservacion;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv1_claveestd", type="string", length=8, nullable=true)
     */
    private $deriv1Claveestd;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv1_nom_efector", type="string", length=255, nullable=true)
     */
    private $deriv1NomEfector;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv1_cod_dep_adm", type="string", length=1, nullable=true)
     */
    private $deriv1CodDepAdm;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv1_cod_loc", type="string", length=2, nullable=true)
     */
    private $deriv1CodLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv1_cod_dpto", type="string", length=3, nullable=true)
     */
    private $deriv1CodDpto;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv1_cod_prov", type="string", length=2, nullable=true)
     */
    private $deriv1CodProv;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv1_cod_pais", type="string", length=3, nullable=true)
     */
    private $deriv1CodPais;

    /**
     * @var string
     *
     * @ORM\Column(name="diag_presuntivo_texto", type="string", length=255, nullable=false)
     */
    private $diagPresuntivoTexto;

    /**
     * @var string
     *
     * @ORM\Column(name="diag_principal_texto", type="string", length=255, nullable=true)
     */
    private $diagPrincipalTexto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="egr_fecha_hora", type="datetime", nullable=true)
     */
    private $egrFechaHora;

    /**
     * @var integer
     *
     * @ORM\Column(name="egr_total_dias_estada", type="smallint", nullable=true)
     */
    private $egrTotalDiasEstada;

    /**
     * @var boolean
     *
     * @ORM\Column(name="egr_prorroga", type="boolean", nullable=true)
     */
    private $egrProrroga;

    /**
     * @var integer
     *
     * @ORM\Column(name="egr_dias_prorroga", type="smallint", nullable=true)
     */
    private $egrDiasProrroga;

    /**
     * @var string
     *
     * @ORM\Column(name="egr_tipo", type="string", length=1, nullable=true)
     */
    private $egrTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="egr_medio_traslado", type="string", length=1, nullable=true)
     */
    private $egrMedioTraslado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="egr_autopsia", type="boolean", nullable=true)
     */
    private $egrAutopsia;

    /**
     * @var string
     *
     * @ORM\Column(name="egr_cod_servicio", type="string", length=3, nullable=true)
     */
    private $egrCodServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="egr_sector", type="string", length=1, nullable=true)
     */
    private $egrSector;

    /**
     * @var string
     *
     * @ORM\Column(name="egr_subsector", type="string", length=1, nullable=true)
     */
    private $egrSubsector;

    /**
     * @var boolean
     *
     * @ORM\Column(name="egr_completo", type="boolean", nullable=false)
     */
    private $egrCompleto;

    /**
     * @var integer
     *
     * @ORM\Column(name="egr_medico_idperson", type="integer", nullable=true)
     */
    private $egrMedicoIdperson;

    /**
     * @var string
     *
     * @ORM\Column(name="causa_ext_producido_por", type="string", length=1, nullable=true)
     */
    private $causaExtProducidoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="causa_ext_lugar", type="string", length=1, nullable=true)
     */
    private $causaExtLugar;

    /**
     * @var string
     *
     * @ORM\Column(name="causa_ext_descripcion", type="string", length=255, nullable=true)
     */
    private $causaExtDescripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv2_claveestd", type="string", length=8, nullable=true)
     */
    private $deriv2Claveestd;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv2_nom_efector", type="string", length=255, nullable=true)
     */
    private $deriv2NomEfector;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv2_cod_dep_adm", type="string", length=1, nullable=true)
     */
    private $deriv2CodDepAdm;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv2_cod_loc", type="string", length=2, nullable=true)
     */
    private $deriv2CodLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv2_cod_dpto", type="string", length=3, nullable=true)
     */
    private $deriv2CodDpto;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv2_cod_prov", type="string", length=2, nullable=true)
     */
    private $deriv2CodProv;

    /**
     * @var string
     *
     * @ORM\Column(name="deriv2_cod_pais", type="string", length=3, nullable=true)
     */
    private $deriv2CodPais;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nac_fecha", type="date", nullable=true)
     */
    private $nacFecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nac_semanas_gest", type="boolean", nullable=true)
     */
    private $nacSemanasGest;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nac_paridad", type="boolean", nullable=true)
     */
    private $nacParidad;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nac_parto_multiple", type="boolean", nullable=true)
     */
    private $nacPartoMultiple;

    /**
     * @var string
     *
     * @ORM\Column(name="esp_pred_cod_servicio", type="string", length=3, nullable=true)
     */
    private $espPredCodServicio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="backup_id_tipo_doc", type="boolean", nullable=false)
     */
    private $backupIdTipoDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="backup_nro_doc", type="integer", nullable=false)
     */
    private $backupNroDoc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="backup_egr_medico_id_tipo_doc", type="boolean", nullable=true)
     */
    private $backupEgrMedicoIdTipoDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="backup_egr_medico_nro_doc", type="integer", nullable=true)
     */
    private $backupEgrMedicoNroDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="backup_egr_medico_matricula", type="smallint", nullable=true)
     */
    private $backupEgrMedicoMatricula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_internacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInternacion;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Ciex4
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Ciex4")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="causa_ext_id_ciex_4", referencedColumnName="id_ciex_4")
     * })
     */
    private $causaExtCiex4;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ing_id_servicio_estadistica", referencedColumnName="id_servicio_estadistica")
     * })
     */
    private $ingServicioEstadistica;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="egr_id_servicio_estadistica", referencedColumnName="id_servicio_estadistica")
     * })
     */
    private $egrServicioEstadistica;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Ciex4
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Ciex4")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diag_presuntivo_id_ciex_4", referencedColumnName="id_ciex_4")
     * })
     */
    private $diagPresuntivoCiex4;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Localidades
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Localidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_localidad", referencedColumnName="id_localidad")
     * })
     */
    private $idLocalidad;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Efectores
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="deriv1_id_efector", referencedColumnName="id_efector")
     * })
     */
    private $deriv1Efector;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Efectores
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="deriv2_id_efector", referencedColumnName="id_efector")
     * })
     */
    private $deriv2Efector;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Efectores
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector", referencedColumnName="id_efector")
     * })
     */
    private $idEfector;



    /**
     * Set periodoInforme
     *
     * @param string $periodoInforme
     * @return Internaciones
     */
    public function setPeriodoInforme($periodoInforme)
    {
        $this->periodoInforme = $periodoInforme;

        return $this;
    }

    /**
     * Get periodoInforme
     *
     * @return string 
     */
    public function getPeriodoInforme()
    {
        return $this->periodoInforme;
    }

    /**
     * Set nroInforme
     *
     * @param integer $nroInforme
     * @return Internaciones
     */
    public function setNroInforme($nroInforme)
    {
        $this->nroInforme = $nroInforme;

        return $this;
    }

    /**
     * Get nroInforme
     *
     * @return integer 
     */
    public function getNroInforme()
    {
        return $this->nroInforme;
    }

    /**
     * Set claveestd
     *
     * @param string $claveestd
     * @return Internaciones
     */
    public function setClaveestd($claveestd)
    {
        $this->claveestd = $claveestd;

        return $this;
    }

    /**
     * Get claveestd
     *
     * @return string 
     */
    public function getClaveestd()
    {
        return $this->claveestd;
    }

    /**
     * Set nomEfector
     *
     * @param string $nomEfector
     * @return Internaciones
     */
    public function setNomEfector($nomEfector)
    {
        $this->nomEfector = $nomEfector;

        return $this;
    }

    /**
     * Get nomEfector
     *
     * @return string 
     */
    public function getNomEfector()
    {
        return $this->nomEfector;
    }

    /**
     * Set codDpto
     *
     * @param string $codDpto
     * @return Internaciones
     */
    public function setCodDpto($codDpto)
    {
        $this->codDpto = $codDpto;

        return $this;
    }

    /**
     * Get codDpto
     *
     * @return string 
     */
    public function getCodDpto()
    {
        return $this->codDpto;
    }

    /**
     * Set nodo
     *
     * @param boolean $nodo
     * @return Internaciones
     */
    public function setNodo($nodo)
    {
        $this->nodo = $nodo;

        return $this;
    }

    /**
     * Get nodo
     *
     * @return boolean 
     */
    public function getNodo()
    {
        return $this->nodo;
    }

    /**
     * Set codDepAdm
     *
     * @param string $codDepAdm
     * @return Internaciones
     */
    public function setCodDepAdm($codDepAdm)
    {
        $this->codDepAdm = $codDepAdm;

        return $this;
    }

    /**
     * Get codDepAdm
     *
     * @return string 
     */
    public function getCodDepAdm()
    {
        return $this->codDepAdm;
    }

    /**
     * Set idPaciente
     *
     * @param integer $idPaciente
     * @return Internaciones
     */
    public function setIdPaciente($idPaciente)
    {
        $this->idPaciente = $idPaciente;

        return $this;
    }

    /**
     * Get idPaciente
     *
     * @return integer 
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * Set idPersona
     *
     * @param integer $idPersona
     * @return Internaciones
     */
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;

        return $this;
    }

    /**
     * Get idPersona
     *
     * @return integer 
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Internaciones
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Internaciones
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Internaciones
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set domCalle
     *
     * @param string $domCalle
     * @return Internaciones
     */
    public function setDomCalle($domCalle)
    {
        $this->domCalle = $domCalle;

        return $this;
    }

    /**
     * Get domCalle
     *
     * @return string 
     */
    public function getDomCalle()
    {
        return $this->domCalle;
    }

    /**
     * Set domNro
     *
     * @param string $domNro
     * @return Internaciones
     */
    public function setDomNro($domNro)
    {
        $this->domNro = $domNro;

        return $this;
    }

    /**
     * Get domNro
     *
     * @return string 
     */
    public function getDomNro()
    {
        return $this->domNro;
    }

    /**
     * Set domPiso
     *
     * @param string $domPiso
     * @return Internaciones
     */
    public function setDomPiso($domPiso)
    {
        $this->domPiso = $domPiso;

        return $this;
    }

    /**
     * Get domPiso
     *
     * @return string 
     */
    public function getDomPiso()
    {
        return $this->domPiso;
    }

    /**
     * Set domDpto
     *
     * @param string $domDpto
     * @return Internaciones
     */
    public function setDomDpto($domDpto)
    {
        $this->domDpto = $domDpto;

        return $this;
    }

    /**
     * Get domDpto
     *
     * @return string 
     */
    public function getDomDpto()
    {
        return $this->domDpto;
    }

    /**
     * Set domTelefono
     *
     * @param string $domTelefono
     * @return Internaciones
     */
    public function setDomTelefono($domTelefono)
    {
        $this->domTelefono = $domTelefono;

        return $this;
    }

    /**
     * Get domTelefono
     *
     * @return string 
     */
    public function getDomTelefono()
    {
        return $this->domTelefono;
    }

    /**
     * Set domBarrio
     *
     * @param string $domBarrio
     * @return Internaciones
     */
    public function setDomBarrio($domBarrio)
    {
        $this->domBarrio = $domBarrio;

        return $this;
    }

    /**
     * Get domBarrio
     *
     * @return string 
     */
    public function getDomBarrio()
    {
        return $this->domBarrio;
    }

    /**
     * Set domCodLoc
     *
     * @param string $domCodLoc
     * @return Internaciones
     */
    public function setDomCodLoc($domCodLoc)
    {
        $this->domCodLoc = $domCodLoc;

        return $this;
    }

    /**
     * Get domCodLoc
     *
     * @return string 
     */
    public function getDomCodLoc()
    {
        return $this->domCodLoc;
    }

    /**
     * Set domCodDpto
     *
     * @param string $domCodDpto
     * @return Internaciones
     */
    public function setDomCodDpto($domCodDpto)
    {
        $this->domCodDpto = $domCodDpto;

        return $this;
    }

    /**
     * Get domCodDpto
     *
     * @return string 
     */
    public function getDomCodDpto()
    {
        return $this->domCodDpto;
    }

    /**
     * Set domCodProv
     *
     * @param string $domCodProv
     * @return Internaciones
     */
    public function setDomCodProv($domCodProv)
    {
        $this->domCodProv = $domCodProv;

        return $this;
    }

    /**
     * Get domCodProv
     *
     * @return string 
     */
    public function getDomCodProv()
    {
        return $this->domCodProv;
    }

    /**
     * Set domCodPais
     *
     * @param string $domCodPais
     * @return Internaciones
     */
    public function setDomCodPais($domCodPais)
    {
        $this->domCodPais = $domCodPais;

        return $this;
    }

    /**
     * Get domCodPais
     *
     * @return string 
     */
    public function getDomCodPais()
    {
        return $this->domCodPais;
    }

    /**
     * Set osAsociadoA
     *
     * @param string $osAsociadoA
     * @return Internaciones
     */
    public function setOsAsociadoA($osAsociadoA)
    {
        $this->osAsociadoA = $osAsociadoA;

        return $this;
    }

    /**
     * Get osAsociadoA
     *
     * @return string 
     */
    public function getOsAsociadoA()
    {
        return $this->osAsociadoA;
    }

    /**
     * Set osNombre
     *
     * @param string $osNombre
     * @return Internaciones
     */
    public function setOsNombre($osNombre)
    {
        $this->osNombre = $osNombre;

        return $this;
    }

    /**
     * Get osNombre
     *
     * @return string 
     */
    public function getOsNombre()
    {
        return $this->osNombre;
    }

    /**
     * Set osRnos
     *
     * @param string $osRnos
     * @return Internaciones
     */
    public function setOsRnos($osRnos)
    {
        $this->osRnos = $osRnos;

        return $this;
    }

    /**
     * Get osRnos
     *
     * @return string 
     */
    public function getOsRnos()
    {
        return $this->osRnos;
    }

    /**
     * Set osCondicion
     *
     * @param string $osCondicion
     * @return Internaciones
     */
    public function setOsCondicion($osCondicion)
    {
        $this->osCondicion = $osCondicion;

        return $this;
    }

    /**
     * Get osCondicion
     *
     * @return string 
     */
    public function getOsCondicion()
    {
        return $this->osCondicion;
    }

    /**
     * Set situacionLaboral
     *
     * @param string $situacionLaboral
     * @return Internaciones
     */
    public function setSituacionLaboral($situacionLaboral)
    {
        $this->situacionLaboral = $situacionLaboral;

        return $this;
    }

    /**
     * Get situacionLaboral
     *
     * @return string 
     */
    public function getSituacionLaboral()
    {
        return $this->situacionLaboral;
    }

    /**
     * Set instruccion
     *
     * @param string $instruccion
     * @return Internaciones
     */
    public function setInstruccion($instruccion)
    {
        $this->instruccion = $instruccion;

        return $this;
    }

    /**
     * Get instruccion
     *
     * @return string 
     */
    public function getInstruccion()
    {
        return $this->instruccion;
    }

    /**
     * Set ocupacionHabitual
     *
     * @param string $ocupacionHabitual
     * @return Internaciones
     */
    public function setOcupacionHabitual($ocupacionHabitual)
    {
        $this->ocupacionHabitual = $ocupacionHabitual;

        return $this;
    }

    /**
     * Get ocupacionHabitual
     *
     * @return string 
     */
    public function getOcupacionHabitual()
    {
        return $this->ocupacionHabitual;
    }

    /**
     * Set ingHospitalizadoPor
     *
     * @param string $ingHospitalizadoPor
     * @return Internaciones
     */
    public function setIngHospitalizadoPor($ingHospitalizadoPor)
    {
        $this->ingHospitalizadoPor = $ingHospitalizadoPor;

        return $this;
    }

    /**
     * Get ingHospitalizadoPor
     *
     * @return string 
     */
    public function getIngHospitalizadoPor()
    {
        return $this->ingHospitalizadoPor;
    }

    /**
     * Set ingFechaHora
     *
     * @param \DateTime $ingFechaHora
     * @return Internaciones
     */
    public function setIngFechaHora($ingFechaHora)
    {
        $this->ingFechaHora = $ingFechaHora;

        return $this;
    }

    /**
     * Get ingFechaHora
     *
     * @return \DateTime 
     */
    public function getIngFechaHora()
    {
        return $this->ingFechaHora;
    }

    /**
     * Set ingEdad
     *
     * @param boolean $ingEdad
     * @return Internaciones
     */
    public function setIngEdad($ingEdad)
    {
        $this->ingEdad = $ingEdad;

        return $this;
    }

    /**
     * Get ingEdad
     *
     * @return boolean 
     */
    public function getIngEdad()
    {
        return $this->ingEdad;
    }

    /**
     * Set ingTipoEdad
     *
     * @param string $ingTipoEdad
     * @return Internaciones
     */
    public function setIngTipoEdad($ingTipoEdad)
    {
        $this->ingTipoEdad = $ingTipoEdad;

        return $this;
    }

    /**
     * Get ingTipoEdad
     *
     * @return string 
     */
    public function getIngTipoEdad()
    {
        return $this->ingTipoEdad;
    }

    /**
     * Set ingMedioTraslado
     *
     * @param string $ingMedioTraslado
     * @return Internaciones
     */
    public function setIngMedioTraslado($ingMedioTraslado)
    {
        $this->ingMedioTraslado = $ingMedioTraslado;

        return $this;
    }

    /**
     * Get ingMedioTraslado
     *
     * @return string 
     */
    public function getIngMedioTraslado()
    {
        return $this->ingMedioTraslado;
    }

    /**
     * Set ingCodServicio
     *
     * @param string $ingCodServicio
     * @return Internaciones
     */
    public function setIngCodServicio($ingCodServicio)
    {
        $this->ingCodServicio = $ingCodServicio;

        return $this;
    }

    /**
     * Get ingCodServicio
     *
     * @return string 
     */
    public function getIngCodServicio()
    {
        return $this->ingCodServicio;
    }

    /**
     * Set ingSector
     *
     * @param string $ingSector
     * @return Internaciones
     */
    public function setIngSector($ingSector)
    {
        $this->ingSector = $ingSector;

        return $this;
    }

    /**
     * Get ingSector
     *
     * @return string 
     */
    public function getIngSector()
    {
        return $this->ingSector;
    }

    /**
     * Set ingSubsector
     *
     * @param string $ingSubsector
     * @return Internaciones
     */
    public function setIngSubsector($ingSubsector)
    {
        $this->ingSubsector = $ingSubsector;

        return $this;
    }

    /**
     * Get ingSubsector
     *
     * @return string 
     */
    public function getIngSubsector()
    {
        return $this->ingSubsector;
    }

    /**
     * Set ingMedicoIdperson
     *
     * @param integer $ingMedicoIdperson
     * @return Internaciones
     */
    public function setIngMedicoIdperson($ingMedicoIdperson)
    {
        $this->ingMedicoIdperson = $ingMedicoIdperson;

        return $this;
    }

    /**
     * Get ingMedicoIdperson
     *
     * @return integer 
     */
    public function getIngMedicoIdperson()
    {
        return $this->ingMedicoIdperson;
    }

    /**
     * Set ingDerivado
     *
     * @param boolean $ingDerivado
     * @return Internaciones
     */
    public function setIngDerivado($ingDerivado)
    {
        $this->ingDerivado = $ingDerivado;

        return $this;
    }

    /**
     * Get ingDerivado
     *
     * @return boolean 
     */
    public function getIngDerivado()
    {
        return $this->ingDerivado;
    }

    /**
     * Set ingHcSies
     *
     * @param string $ingHcSies
     * @return Internaciones
     */
    public function setIngHcSies($ingHcSies)
    {
        $this->ingHcSies = $ingHcSies;

        return $this;
    }

    /**
     * Get ingHcSies
     *
     * @return string 
     */
    public function getIngHcSies()
    {
        return $this->ingHcSies;
    }

    /**
     * Set ingJudicial
     *
     * @param boolean $ingJudicial
     * @return Internaciones
     */
    public function setIngJudicial($ingJudicial)
    {
        $this->ingJudicial = $ingJudicial;

        return $this;
    }

    /**
     * Get ingJudicial
     *
     * @return boolean 
     */
    public function getIngJudicial()
    {
        return $this->ingJudicial;
    }

    /**
     * Set ingJudicialObservacion
     *
     * @param string $ingJudicialObservacion
     * @return Internaciones
     */
    public function setIngJudicialObservacion($ingJudicialObservacion)
    {
        $this->ingJudicialObservacion = $ingJudicialObservacion;

        return $this;
    }

    /**
     * Get ingJudicialObservacion
     *
     * @return string 
     */
    public function getIngJudicialObservacion()
    {
        return $this->ingJudicialObservacion;
    }

    /**
     * Set deriv1Claveestd
     *
     * @param string $deriv1Claveestd
     * @return Internaciones
     */
    public function setDeriv1Claveestd($deriv1Claveestd)
    {
        $this->deriv1Claveestd = $deriv1Claveestd;

        return $this;
    }

    /**
     * Get deriv1Claveestd
     *
     * @return string 
     */
    public function getDeriv1Claveestd()
    {
        return $this->deriv1Claveestd;
    }

    /**
     * Set deriv1NomEfector
     *
     * @param string $deriv1NomEfector
     * @return Internaciones
     */
    public function setDeriv1NomEfector($deriv1NomEfector)
    {
        $this->deriv1NomEfector = $deriv1NomEfector;

        return $this;
    }

    /**
     * Get deriv1NomEfector
     *
     * @return string 
     */
    public function getDeriv1NomEfector()
    {
        return $this->deriv1NomEfector;
    }

    /**
     * Set deriv1CodDepAdm
     *
     * @param string $deriv1CodDepAdm
     * @return Internaciones
     */
    public function setDeriv1CodDepAdm($deriv1CodDepAdm)
    {
        $this->deriv1CodDepAdm = $deriv1CodDepAdm;

        return $this;
    }

    /**
     * Get deriv1CodDepAdm
     *
     * @return string 
     */
    public function getDeriv1CodDepAdm()
    {
        return $this->deriv1CodDepAdm;
    }

    /**
     * Set deriv1CodLoc
     *
     * @param string $deriv1CodLoc
     * @return Internaciones
     */
    public function setDeriv1CodLoc($deriv1CodLoc)
    {
        $this->deriv1CodLoc = $deriv1CodLoc;

        return $this;
    }

    /**
     * Get deriv1CodLoc
     *
     * @return string 
     */
    public function getDeriv1CodLoc()
    {
        return $this->deriv1CodLoc;
    }

    /**
     * Set deriv1CodDpto
     *
     * @param string $deriv1CodDpto
     * @return Internaciones
     */
    public function setDeriv1CodDpto($deriv1CodDpto)
    {
        $this->deriv1CodDpto = $deriv1CodDpto;

        return $this;
    }

    /**
     * Get deriv1CodDpto
     *
     * @return string 
     */
    public function getDeriv1CodDpto()
    {
        return $this->deriv1CodDpto;
    }

    /**
     * Set deriv1CodProv
     *
     * @param string $deriv1CodProv
     * @return Internaciones
     */
    public function setDeriv1CodProv($deriv1CodProv)
    {
        $this->deriv1CodProv = $deriv1CodProv;

        return $this;
    }

    /**
     * Get deriv1CodProv
     *
     * @return string 
     */
    public function getDeriv1CodProv()
    {
        return $this->deriv1CodProv;
    }

    /**
     * Set deriv1CodPais
     *
     * @param string $deriv1CodPais
     * @return Internaciones
     */
    public function setDeriv1CodPais($deriv1CodPais)
    {
        $this->deriv1CodPais = $deriv1CodPais;

        return $this;
    }

    /**
     * Get deriv1CodPais
     *
     * @return string 
     */
    public function getDeriv1CodPais()
    {
        return $this->deriv1CodPais;
    }

    /**
     * Set diagPresuntivoTexto
     *
     * @param string $diagPresuntivoTexto
     * @return Internaciones
     */
    public function setDiagPresuntivoTexto($diagPresuntivoTexto)
    {
        $this->diagPresuntivoTexto = $diagPresuntivoTexto;

        return $this;
    }

    /**
     * Get diagPresuntivoTexto
     *
     * @return string 
     */
    public function getDiagPresuntivoTexto()
    {
        return $this->diagPresuntivoTexto;
    }

    /**
     * Set diagPrincipalTexto
     *
     * @param string $diagPrincipalTexto
     * @return Internaciones
     */
    public function setDiagPrincipalTexto($diagPrincipalTexto)
    {
        $this->diagPrincipalTexto = $diagPrincipalTexto;

        return $this;
    }

    /**
     * Get diagPrincipalTexto
     *
     * @return string 
     */
    public function getDiagPrincipalTexto()
    {
        return $this->diagPrincipalTexto;
    }

    /**
     * Set egrFechaHora
     *
     * @param \DateTime $egrFechaHora
     * @return Internaciones
     */
    public function setEgrFechaHora($egrFechaHora)
    {
        $this->egrFechaHora = $egrFechaHora;

        return $this;
    }

    /**
     * Get egrFechaHora
     *
     * @return \DateTime 
     */
    public function getEgrFechaHora()
    {
        return $this->egrFechaHora;
    }

    /**
     * Set egrTotalDiasEstada
     *
     * @param integer $egrTotalDiasEstada
     * @return Internaciones
     */
    public function setEgrTotalDiasEstada($egrTotalDiasEstada)
    {
        $this->egrTotalDiasEstada = $egrTotalDiasEstada;

        return $this;
    }

    /**
     * Get egrTotalDiasEstada
     *
     * @return integer 
     */
    public function getEgrTotalDiasEstada()
    {
        return $this->egrTotalDiasEstada;
    }

    /**
     * Set egrProrroga
     *
     * @param boolean $egrProrroga
     * @return Internaciones
     */
    public function setEgrProrroga($egrProrroga)
    {
        $this->egrProrroga = $egrProrroga;

        return $this;
    }

    /**
     * Get egrProrroga
     *
     * @return boolean 
     */
    public function getEgrProrroga()
    {
        return $this->egrProrroga;
    }

    /**
     * Set egrDiasProrroga
     *
     * @param integer $egrDiasProrroga
     * @return Internaciones
     */
    public function setEgrDiasProrroga($egrDiasProrroga)
    {
        $this->egrDiasProrroga = $egrDiasProrroga;

        return $this;
    }

    /**
     * Get egrDiasProrroga
     *
     * @return integer 
     */
    public function getEgrDiasProrroga()
    {
        return $this->egrDiasProrroga;
    }

    /**
     * Set egrTipo
     *
     * @param string $egrTipo
     * @return Internaciones
     */
    public function setEgrTipo($egrTipo)
    {
        $this->egrTipo = $egrTipo;

        return $this;
    }

    /**
     * Get egrTipo
     *
     * @return string 
     */
    public function getEgrTipo()
    {
        return $this->egrTipo;
    }

    /**
     * Set egrMedioTraslado
     *
     * @param string $egrMedioTraslado
     * @return Internaciones
     */
    public function setEgrMedioTraslado($egrMedioTraslado)
    {
        $this->egrMedioTraslado = $egrMedioTraslado;

        return $this;
    }

    /**
     * Get egrMedioTraslado
     *
     * @return string 
     */
    public function getEgrMedioTraslado()
    {
        return $this->egrMedioTraslado;
    }

    /**
     * Set egrAutopsia
     *
     * @param boolean $egrAutopsia
     * @return Internaciones
     */
    public function setEgrAutopsia($egrAutopsia)
    {
        $this->egrAutopsia = $egrAutopsia;

        return $this;
    }

    /**
     * Get egrAutopsia
     *
     * @return boolean 
     */
    public function getEgrAutopsia()
    {
        return $this->egrAutopsia;
    }

    /**
     * Set egrCodServicio
     *
     * @param string $egrCodServicio
     * @return Internaciones
     */
    public function setEgrCodServicio($egrCodServicio)
    {
        $this->egrCodServicio = $egrCodServicio;

        return $this;
    }

    /**
     * Get egrCodServicio
     *
     * @return string 
     */
    public function getEgrCodServicio()
    {
        return $this->egrCodServicio;
    }

    /**
     * Set egrSector
     *
     * @param string $egrSector
     * @return Internaciones
     */
    public function setEgrSector($egrSector)
    {
        $this->egrSector = $egrSector;

        return $this;
    }

    /**
     * Get egrSector
     *
     * @return string 
     */
    public function getEgrSector()
    {
        return $this->egrSector;
    }

    /**
     * Set egrSubsector
     *
     * @param string $egrSubsector
     * @return Internaciones
     */
    public function setEgrSubsector($egrSubsector)
    {
        $this->egrSubsector = $egrSubsector;

        return $this;
    }

    /**
     * Get egrSubsector
     *
     * @return string 
     */
    public function getEgrSubsector()
    {
        return $this->egrSubsector;
    }

    /**
     * Set egrCompleto
     *
     * @param boolean $egrCompleto
     * @return Internaciones
     */
    public function setEgrCompleto($egrCompleto)
    {
        $this->egrCompleto = $egrCompleto;

        return $this;
    }

    /**
     * Get egrCompleto
     *
     * @return boolean 
     */
    public function getEgrCompleto()
    {
        return $this->egrCompleto;
    }

    /**
     * Set egrMedicoIdperson
     *
     * @param integer $egrMedicoIdperson
     * @return Internaciones
     */
    public function setEgrMedicoIdperson($egrMedicoIdperson)
    {
        $this->egrMedicoIdperson = $egrMedicoIdperson;

        return $this;
    }

    /**
     * Get egrMedicoIdperson
     *
     * @return integer 
     */
    public function getEgrMedicoIdperson()
    {
        return $this->egrMedicoIdperson;
    }

    /**
     * Set causaExtProducidoPor
     *
     * @param string $causaExtProducidoPor
     * @return Internaciones
     */
    public function setCausaExtProducidoPor($causaExtProducidoPor)
    {
        $this->causaExtProducidoPor = $causaExtProducidoPor;

        return $this;
    }

    /**
     * Get causaExtProducidoPor
     *
     * @return string 
     */
    public function getCausaExtProducidoPor()
    {
        return $this->causaExtProducidoPor;
    }

    /**
     * Set causaExtLugar
     *
     * @param string $causaExtLugar
     * @return Internaciones
     */
    public function setCausaExtLugar($causaExtLugar)
    {
        $this->causaExtLugar = $causaExtLugar;

        return $this;
    }

    /**
     * Get causaExtLugar
     *
     * @return string 
     */
    public function getCausaExtLugar()
    {
        return $this->causaExtLugar;
    }

    /**
     * Set causaExtDescripcion
     *
     * @param string $causaExtDescripcion
     * @return Internaciones
     */
    public function setCausaExtDescripcion($causaExtDescripcion)
    {
        $this->causaExtDescripcion = $causaExtDescripcion;

        return $this;
    }

    /**
     * Get causaExtDescripcion
     *
     * @return string 
     */
    public function getCausaExtDescripcion()
    {
        return $this->causaExtDescripcion;
    }

    /**
     * Set deriv2Claveestd
     *
     * @param string $deriv2Claveestd
     * @return Internaciones
     */
    public function setDeriv2Claveestd($deriv2Claveestd)
    {
        $this->deriv2Claveestd = $deriv2Claveestd;

        return $this;
    }

    /**
     * Get deriv2Claveestd
     *
     * @return string 
     */
    public function getDeriv2Claveestd()
    {
        return $this->deriv2Claveestd;
    }

    /**
     * Set deriv2NomEfector
     *
     * @param string $deriv2NomEfector
     * @return Internaciones
     */
    public function setDeriv2NomEfector($deriv2NomEfector)
    {
        $this->deriv2NomEfector = $deriv2NomEfector;

        return $this;
    }

    /**
     * Get deriv2NomEfector
     *
     * @return string 
     */
    public function getDeriv2NomEfector()
    {
        return $this->deriv2NomEfector;
    }

    /**
     * Set deriv2CodDepAdm
     *
     * @param string $deriv2CodDepAdm
     * @return Internaciones
     */
    public function setDeriv2CodDepAdm($deriv2CodDepAdm)
    {
        $this->deriv2CodDepAdm = $deriv2CodDepAdm;

        return $this;
    }

    /**
     * Get deriv2CodDepAdm
     *
     * @return string 
     */
    public function getDeriv2CodDepAdm()
    {
        return $this->deriv2CodDepAdm;
    }

    /**
     * Set deriv2CodLoc
     *
     * @param string $deriv2CodLoc
     * @return Internaciones
     */
    public function setDeriv2CodLoc($deriv2CodLoc)
    {
        $this->deriv2CodLoc = $deriv2CodLoc;

        return $this;
    }

    /**
     * Get deriv2CodLoc
     *
     * @return string 
     */
    public function getDeriv2CodLoc()
    {
        return $this->deriv2CodLoc;
    }

    /**
     * Set deriv2CodDpto
     *
     * @param string $deriv2CodDpto
     * @return Internaciones
     */
    public function setDeriv2CodDpto($deriv2CodDpto)
    {
        $this->deriv2CodDpto = $deriv2CodDpto;

        return $this;
    }

    /**
     * Get deriv2CodDpto
     *
     * @return string 
     */
    public function getDeriv2CodDpto()
    {
        return $this->deriv2CodDpto;
    }

    /**
     * Set deriv2CodProv
     *
     * @param string $deriv2CodProv
     * @return Internaciones
     */
    public function setDeriv2CodProv($deriv2CodProv)
    {
        $this->deriv2CodProv = $deriv2CodProv;

        return $this;
    }

    /**
     * Get deriv2CodProv
     *
     * @return string 
     */
    public function getDeriv2CodProv()
    {
        return $this->deriv2CodProv;
    }

    /**
     * Set deriv2CodPais
     *
     * @param string $deriv2CodPais
     * @return Internaciones
     */
    public function setDeriv2CodPais($deriv2CodPais)
    {
        $this->deriv2CodPais = $deriv2CodPais;

        return $this;
    }

    /**
     * Get deriv2CodPais
     *
     * @return string 
     */
    public function getDeriv2CodPais()
    {
        return $this->deriv2CodPais;
    }

    /**
     * Set nacFecha
     *
     * @param \DateTime $nacFecha
     * @return Internaciones
     */
    public function setNacFecha($nacFecha)
    {
        $this->nacFecha = $nacFecha;

        return $this;
    }

    /**
     * Get nacFecha
     *
     * @return \DateTime 
     */
    public function getNacFecha()
    {
        return $this->nacFecha;
    }

    /**
     * Set nacSemanasGest
     *
     * @param boolean $nacSemanasGest
     * @return Internaciones
     */
    public function setNacSemanasGest($nacSemanasGest)
    {
        $this->nacSemanasGest = $nacSemanasGest;

        return $this;
    }

    /**
     * Get nacSemanasGest
     *
     * @return boolean 
     */
    public function getNacSemanasGest()
    {
        return $this->nacSemanasGest;
    }

    /**
     * Set nacParidad
     *
     * @param boolean $nacParidad
     * @return Internaciones
     */
    public function setNacParidad($nacParidad)
    {
        $this->nacParidad = $nacParidad;

        return $this;
    }

    /**
     * Get nacParidad
     *
     * @return boolean 
     */
    public function getNacParidad()
    {
        return $this->nacParidad;
    }

    /**
     * Set nacPartoMultiple
     *
     * @param boolean $nacPartoMultiple
     * @return Internaciones
     */
    public function setNacPartoMultiple($nacPartoMultiple)
    {
        $this->nacPartoMultiple = $nacPartoMultiple;

        return $this;
    }

    /**
     * Get nacPartoMultiple
     *
     * @return boolean 
     */
    public function getNacPartoMultiple()
    {
        return $this->nacPartoMultiple;
    }

    /**
     * Set espPredCodServicio
     *
     * @param string $espPredCodServicio
     * @return Internaciones
     */
    public function setEspPredCodServicio($espPredCodServicio)
    {
        $this->espPredCodServicio = $espPredCodServicio;

        return $this;
    }

    /**
     * Get espPredCodServicio
     *
     * @return string 
     */
    public function getEspPredCodServicio()
    {
        return $this->espPredCodServicio;
    }

    /**
     * Set backupIdTipoDoc
     *
     * @param boolean $backupIdTipoDoc
     * @return Internaciones
     */
    public function setBackupIdTipoDoc($backupIdTipoDoc)
    {
        $this->backupIdTipoDoc = $backupIdTipoDoc;

        return $this;
    }

    /**
     * Get backupIdTipoDoc
     *
     * @return boolean 
     */
    public function getBackupIdTipoDoc()
    {
        return $this->backupIdTipoDoc;
    }

    /**
     * Set backupNroDoc
     *
     * @param integer $backupNroDoc
     * @return Internaciones
     */
    public function setBackupNroDoc($backupNroDoc)
    {
        $this->backupNroDoc = $backupNroDoc;

        return $this;
    }

    /**
     * Get backupNroDoc
     *
     * @return integer 
     */
    public function getBackupNroDoc()
    {
        return $this->backupNroDoc;
    }

    /**
     * Set backupEgrMedicoIdTipoDoc
     *
     * @param boolean $backupEgrMedicoIdTipoDoc
     * @return Internaciones
     */
    public function setBackupEgrMedicoIdTipoDoc($backupEgrMedicoIdTipoDoc)
    {
        $this->backupEgrMedicoIdTipoDoc = $backupEgrMedicoIdTipoDoc;

        return $this;
    }

    /**
     * Get backupEgrMedicoIdTipoDoc
     *
     * @return boolean 
     */
    public function getBackupEgrMedicoIdTipoDoc()
    {
        return $this->backupEgrMedicoIdTipoDoc;
    }

    /**
     * Set backupEgrMedicoNroDoc
     *
     * @param integer $backupEgrMedicoNroDoc
     * @return Internaciones
     */
    public function setBackupEgrMedicoNroDoc($backupEgrMedicoNroDoc)
    {
        $this->backupEgrMedicoNroDoc = $backupEgrMedicoNroDoc;

        return $this;
    }

    /**
     * Get backupEgrMedicoNroDoc
     *
     * @return integer 
     */
    public function getBackupEgrMedicoNroDoc()
    {
        return $this->backupEgrMedicoNroDoc;
    }

    /**
     * Set backupEgrMedicoMatricula
     *
     * @param integer $backupEgrMedicoMatricula
     * @return Internaciones
     */
    public function setBackupEgrMedicoMatricula($backupEgrMedicoMatricula)
    {
        $this->backupEgrMedicoMatricula = $backupEgrMedicoMatricula;

        return $this;
    }

    /**
     * Get backupEgrMedicoMatricula
     *
     * @return integer 
     */
    public function getBackupEgrMedicoMatricula()
    {
        return $this->backupEgrMedicoMatricula;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Internaciones
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Get idInternacion
     *
     * @return integer 
     */
    public function getIdInternacion()
    {
        return $this->idInternacion;
    }

    /**
     * Set causaExtCiex4
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Ciex4 $causaExtCiex4
     * @return Internaciones
     */
    public function setCausaExtCiex4(\Guaycuru\DBHmi2Bundle\Entity\Ciex4 $causaExtCiex4 = null)
    {
        $this->causaExtCiex4 = $causaExtCiex4;

        return $this;
    }

    /**
     * Get causaExtCiex4
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Ciex4 
     */
    public function getCausaExtCiex4()
    {
        return $this->causaExtCiex4;
    }

    /**
     * Set ingServicioEstadistica
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica $ingServicioEstadistica
     * @return Internaciones
     */
    public function setIngServicioEstadistica(\Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica $ingServicioEstadistica = null)
    {
        $this->ingServicioEstadistica = $ingServicioEstadistica;

        return $this;
    }

    /**
     * Get ingServicioEstadistica
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica 
     */
    public function getIngServicioEstadistica()
    {
        return $this->ingServicioEstadistica;
    }

    /**
     * Set egrServicioEstadistica
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica $egrServicioEstadistica
     * @return Internaciones
     */
    public function setEgrServicioEstadistica(\Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica $egrServicioEstadistica = null)
    {
        $this->egrServicioEstadistica = $egrServicioEstadistica;

        return $this;
    }

    /**
     * Get egrServicioEstadistica
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica 
     */
    public function getEgrServicioEstadistica()
    {
        return $this->egrServicioEstadistica;
    }

    /**
     * Set diagPresuntivoCiex4
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Ciex4 $diagPresuntivoCiex4
     * @return Internaciones
     */
    public function setDiagPresuntivoCiex4(\Guaycuru\DBHmi2Bundle\Entity\Ciex4 $diagPresuntivoCiex4 = null)
    {
        $this->diagPresuntivoCiex4 = $diagPresuntivoCiex4;

        return $this;
    }

    /**
     * Get diagPresuntivoCiex4
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Ciex4 
     */
    public function getDiagPresuntivoCiex4()
    {
        return $this->diagPresuntivoCiex4;
    }

    /**
     * Set idLocalidad
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Localidades $idLocalidad
     * @return Internaciones
     */
    public function setIdLocalidad(\Guaycuru\DBHmi2Bundle\Entity\Localidades $idLocalidad = null)
    {
        $this->idLocalidad = $idLocalidad;

        return $this;
    }

    /**
     * Get idLocalidad
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Localidades 
     */
    public function getIdLocalidad()
    {
        return $this->idLocalidad;
    }

    /**
     * Set deriv1Efector
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Efectores $deriv1Efector
     * @return Internaciones
     */
    public function setDeriv1Efector(\Guaycuru\DBHmi2Bundle\Entity\Efectores $deriv1Efector = null)
    {
        $this->deriv1Efector = $deriv1Efector;

        return $this;
    }

    /**
     * Get deriv1Efector
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Efectores 
     */
    public function getDeriv1Efector()
    {
        return $this->deriv1Efector;
    }

    /**
     * Set deriv2Efector
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Efectores $deriv2Efector
     * @return Internaciones
     */
    public function setDeriv2Efector(\Guaycuru\DBHmi2Bundle\Entity\Efectores $deriv2Efector = null)
    {
        $this->deriv2Efector = $deriv2Efector;

        return $this;
    }

    /**
     * Get deriv2Efector
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Efectores 
     */
    public function getDeriv2Efector()
    {
        return $this->deriv2Efector;
    }

    /**
     * Set idEfector
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Efectores $idEfector
     * @return Internaciones
     */
    public function setIdEfector(\Guaycuru\DBHmi2Bundle\Entity\Efectores $idEfector = null)
    {
        $this->idEfector = $idEfector;

        return $this;
    }

    /**
     * Get idEfector
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Efectores 
     */
    public function getIdEfector()
    {
        return $this->idEfector;
    }
}
