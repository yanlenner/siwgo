function hr(){$("#exam").attr("hidden","true"),$(":input[name=exam]").removeAttr("required")}$(function(){$(":radio[name=re]").change(function(){"si"==$(this).val()&&($("#exam").removeAttr("hidden"),$(":input[name=exam]").attr("required","")),"no"==$(this).val()&&($("#exam").attr("hidden","true"),$(":input[name=exam]").removeAttr("required"),$(":input[name=exam]").val(""))})}),$(document).ready(function(){$("#pdiag").autocomplete({data:{Anodoncia:null,"Dientes supernumerarios":null,"Anomalías del tamaño y de la forma del diente":null,"Dientes moteados":null,"Alteraciones en la formación dentaria, no clasificadas en otra parte":null,"Alteraciones en la erupción dentaria":null,"Síndrome de la erupción dentaria":null,"Otros trastornos del desarrollo de los dientes":null,"Trastorno del desarrollo de los dientes, no especificado":null,"Dientes incluidos":null,"Dientes impactados":null,"Caries limitada al esmalte":null,"Caries de la dentina":null,"Caries del cemento":null,"Caries dentaria detenida":null,Odontoclasia:null,"Otras caries dentales":null,"Caries dental, no especificada":null,"Atrición excesiva de los dientes":null,"Abrasión de los dientes":null,"Erosión de los dientes":null,"Reabsorción patológica de los dientes":null,Hipercementosis:null,"Anquilosis dental":null,"Depósitos [acreciones] en los dientes":null,"Cambios posteruptivos del color de los tejidos dentales duros":null,"Otras enfermedades especificadas de los tejidos duros de los dientes":null,"Enfermedad no especificada de los tejidos dentales duros":null,Pulpitis:null,"Necrosis de la pulpa":null,"Degeneración de la pulpa":null,"Formación anormal de tejido duro en la pulpa":null,"Periodontitis apical aguda originada en la pulpa":null,"Periodontitis apical crónica":null,"Absceso periapical con fistula":null,"Absceso periapical sin fistula":null,"Quiste radicular":null,"Otras enfermedades y las no especificadas de la pulpa y del tejido periapical":null,"Gingivitis aguda":null,"Gingivitis crónica":null,"Periodontitis aguda":null,"Periodontitis crónica":null,Periodontosis:null,"Otras enfermedades periodontales":null,"Enfermedad de periodonto, no especificada":null,"Retracción gingival":null,"Hiperplasia gingival":null,"Lesiones de la encía y de la zona edéntula asociadas con traumatismo":null,"Otros trastornos especificados de la encía y de la zona edéntula":null,"Trastorno no especificado de la encía y de la zona edéntula":null,"Anomalias evidentes del tamaño de los maxilares":null,"Anomalias de la relación maxilobasilar":null,"Anomalias de la relación entre los arcos dentarios":null,"Anomalias de la posición del diente":null,"Maloclusión de tipo no especificado":null,"Anomalias dentofaciales funcionales":null,"Trastornos de la articulación temporomaxilar":null,"Otras anomalías dentofaciales":null,"Anomalía dentofacial, no especificada":null,"Exfoliación de los dientes debida a causas sistémicas":null,"Perdida de dientes debida a accidente, extracción o enfermedad periodontal local":null,"Atrofia de reborde alveolar desdentado":null,"Raíz dental retenida":null,"Otras afecciones especificadas de los dientes y de sus estructuras de sostén":null,"Trastorno de los dientes y de sus estructuras de sostén, no especificado":null,"Quistes originados por el desarrollo de los dientes":null,"Quistes de las fisuras (no odontogénicos)":null,"Otros quistes de los maxilares":null,"Otros quistes de la región bucal, no clasificados en otra parte":null,"Quiste de la región bucal, sin otra especificación":null,"Trastornos del desarrollo de los maxilares":null,"Granuloma central de células gigantes":null,"Afecciones inflamatorias de los maxilares":null,"Alveolitis del maxilar":null,"Otras enfermedades especificadas de los maxilares":null,"Enfermedad de los maxilares, no especificada":null,"Atrofia de glándula salival":null,"Hipertrofia de glándula salival":null,Sialadenitis:null,"Absceso de glándula salival":null,"Fistula de glándula salival":null,Sialolitiasis:null,"Mucocele de glándula salival":null,"Alteraciones de la secreción salival":null,"Otras enfermedades de las glándulas salivales":null,"Enfermedad de glándula salival. No especificada":null,"Estomatitis aftosa recurrente":null,"Otras formas de estomatitis":null,"Celulitis y absceso de boca":null,"Enfermedades de los labios":null,"Mordedura del labio y de la mejilla":null,"Leucoplasia y otras alteraciones del epitelio bucal, incluyendo la lengua":null,"Leucoplasia pilosa":null,"Granuloma y lesiones semejantes de la mucosa bucal":null,"Fibrosis de la submucosa bucal":null,"Hiperplasia irritativa de la mucosa bucal":null,"Otras lesiones y las no especificadas de la mucosa bucal":null,Glositis:null,"Lengua geográfica":null,"Glositis romboidea mediana":null,"Hipertrofia de las papilas linguales":null,"Atrofia de las papilas linguales":null,"Lengua plegada":null,Glosodinia:null,"Otras enfermedades de la lengua":null,"Enfermedad de la lengua, no especificada":null,"Fisura del paladar duro, bilateral":null,"Fisura del paladar duro, unilateral":null,"Fisura del paladar blando, bilateral":null,"Fisura del paladar blando, unilateral":null,"Fisura del paladar duro y del paladar blando, bilateral":null,"Tumor maligno del Labio":null,"Neoplasias malignas de la base de la lengua":null,"Neoplasias malignas de otras partes y sin especificar de la lengua":null,"Neoplasias malignas de la encía":null,"Neoplasias malignas de la base de la boca":null,"Neoplasias malignas del paladar":null,"Neoplasias malignas de la glándula parótida":null,"Neoplasias malignas de otras partes y sin especificar de las glándulas salivares":null}}),$("#examenes").autocomplete({data:{"Análisis en la Sangre":null,"Rx Intraoral":null,"Rx Extraoral":null,"Resonancia Magnética":null,"Tomografía Axial computarizada":null,"Cultivos Bacterianos":null,Biopsia:null,"Modelos de estudio":null,"Fotografías":null,"Revelado de Placa Bacteriana":null,"Sondaje Periodontal":null,"Pruebas de Vitalidad Pulpar":null}})});