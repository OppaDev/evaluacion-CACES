<?php

namespace Database\Seeders;

use App\Models\FuenteInformacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuenteInformacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuentes_informacion = [
            [
                'ind_id' => 1,
                'documento' => 'Planificación estratégica (PEDI) y operativa (POA) institucional.',
            ],
            [
                'ind_id' => 1,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente.',
            ],
            [
                'ind_id' => 1,
                'documento' => 'Modelo educativo o pedagógico.',
            ],
            [
                'ind_id' => 1,
                'documento' => 'Documentos que evidencien el seguimiento y evaluación del PEDI.',
            ],
            [
                'ind_id' => 1,
                'documento' => 'Documentos que evidencien la difusión del PEDI y POA y su ejecución.',
            ],
            [
                'ind_id' => 1,
                'documento' => 'Documentos que evidencien la construcción participativa del PEDI.',
            ],
            [
                'ind_id' => 1,
                'documento' => 'Planificación estratégica y operativa de carreras, programas o unidades académicas y de sus sedes y extensiones. El CEE evaluará una muestra de las planificaciones de carreras y programas o unidades académicas y las evidencias respectivas de su cumplimiento.',
            ],
            [
                'ind_id' => 1,
                'documento' => 'Análisis del aporte, producto del seguimiento y evaluación de la planificación estratégica y operativa para la contribución al aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Normativa interna para la gestión del bienestar universitario.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Documentos que evidencien la planificación y ejecución de los programas y servicios de bienestar universitario.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Evidencias de la prestación de servicios de salud y del cuidado y bienestar infantil (contratos, convenios, infraestructura, dispensarios, laboratorios, entre otros).',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Evidencias de la ejecución de las actividades culturales, artísticas y deportivas u otras extracurriculares de integración de la comunidad universitaria.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Evidencias de los servicios de atención de salud para la comunidad universitaria (verificación in situ).',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Evidencias del seguro de accidentes para estudiantes.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Evidencias de la ejecución de campañas de concientización y prevención de acoso y violencia para la seguridad y convivencia pacífica.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Evidencias de ejecución del protocolo para la atención de vulneración de derechos, casos de todo tipo de violencia, acoso y discriminación.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Evidencias de la ejecución de campañas, programas o proyectos de prevención y control del uso de drogas, bebidas alcohólicas, cigarrillos y derivados del tabaco, así como del fenómeno socioeconómico de las drogas.',
            ],
            [
                'ind_id' => 2,
                'documento' => 'Análisis del aporte de los resultados en el aseguramiento de la calidad y mejora continua de los servicios de bienestar universitario.',
            ],
            [
                'ind_id' => 3,
                'documento' => 'Normativa interna para movilidad e internacionalización institucional.',
            ],
            [
                'ind_id' => 3,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente.',
            ],
            [
                'ind_id' => 3,
                'documento' => 'Convenios u otros instrumentos para movilidad e internacionalización institucional.',
            ],
            [
                'ind_id' => 3,
                'documento' => 'Documentos que evidencien la participación en redes académicas o de investigación internacionales.',
            ],
            [
                'ind_id' => 3,
                'documento' => 'Documentos que evidencien la acreditación, certificación u otros mecanismos de internacionalización, de ser el caso.',
            ],
            [
                'ind_id' => 3,
                'documento' => 'Análisis del aporte de los resultados, producto del seguimiento y evaluación de los procesos de internacionalización y movilidad.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente y su plan operativo anual.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Documentos que evidencien la distribución de infraestructura institucional como: aulas, laboratorios, talleres, centros de simulación, plataformas tecnológicas, salas de cómputo, salas de estudio, espacios físicos, canchas, servicios de alimentación, entre otros, que la institución considere pertinentes. Estos ambientes serán objeto de verificación in situ.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Evidencias de los sistemas de gestión informáticos que utiliza la institución.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Manual, guía o instructivo del sistema de gestión informático institucional.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Manual, guía o instructivo de los ambientes de aprendizaje virtuales.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Plan y ejecución del mantenimiento de la infraestructura física y tecnológica.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Documento que evidencie el presupuesto aprobado y ejecutado en la adquisición y mantenimiento de la infraestructura física y tecnológica.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Documento que evidencie el seguimiento y mantenimiento de infraestructura física y tecnológica.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Acciones y estrategias de accesibilidad universal.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Evidencia de coordinación con el Consejo Nacional para la Igualdad de Discapacidades para implementar requerimientos de accesibilidad universal.',
            ],
            [
                'ind_id' => 4,
                'documento' => 'Documento de análisis de las condiciones, recursos, infraestructura y accesibilidad y su porte al aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 5,
                'documento' => 'Normativa interna para la gestión de bibliotecas.',
            ],
            [
                'ind_id' => 5,
                'documento' => 'Evidencias de la ejecución de convenios interinstitucionales para gestión y acceso al acervo bibliográfico físico y digital',
            ],
            [
                'ind_id' => 5,
                'documento' => 'Evidencias de la actualización del acervo bibliográfico considerando la oferta académica. Verificación in situ de la infraestructura de la(s) biblioteca(s) y el sistema informático utilizado para la gestión del acervo bibliográfico físico y digital.',
            ],
            [
                'ind_id' => 5,
                'documento' => 'Documentos que evidencien el monitoreo y evaluación de la calidad de los servicios bibliotecarios y el análisis del aporte de los resultados para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 6,
                'documento' => 'Normativa interna que regula el Sistema de Gestión de Documental y Archivo.',
            ],
            [
                'ind_id' => 6,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente.',
            ],
            [
                'ind_id' => 6,
                'documento' => 'Documentos que evidencien la planificación, ejecución, seguimiento, evaluación y acciones de mejora del Sistema de Gestión de Documental y Archivo.',
            ],
            [
                'ind_id' => 6,
                'documento' => 'Documentos que evidencien la capacitación, experiencia y formación del personal de la instancia responsable.',
            ],
            [
                'ind_id' => 6,
                'documento' => 'Verificación de espacios físicos acondicionados técnicamente y recursos tecnológicos en la verificación técnica in situ del Sistema de Gestión Documental y Archivo.',
            ],
            [
                'ind_id' => 6,
                'documento' => 'Evidencias de las herramientas técnico - archivísticas del Sistema de Gestión de Documentos y Archivos.',
            ],
            [
                'ind_id' => 6,
                'documento' => 'Evidencias del plan de conservación, preservación y limpieza de documentos.',
            ],
            [
                'ind_id' => 6,
                'documento' => 'Análisis del aporte en el aseguramiento de la calidad para la mejora continua, producto del seguimiento y evaluación de los procesos del Sistema de Gestión de Documentos y Archivos.',
            ],
            [
                'ind_id' => 7,
                'documento' => 'Normativa interna para acciones afirmativas e igualdad de oportunidades.',
            ],
            [
                'ind_id' => 7,
                'documento' => 'Plan institucional de igualdad.',
            ],
            [
                'ind_id' => 7,
                'documento' => 'Documento que evidencie las actividades desarrolladas entorno a la igualdad de oportunidades e interculturalidad.',
            ],
            [
                'ind_id' => 7,
                'documento' => 'Evidencias de las actividades ejecutadas de inclusión de grupos históricamente vulnerables.',
            ],
            [
                'ind_id' => 7,
                'documento' => 'Evidencias de las actividades ejecutadas para prevenir la violencia de género.',
            ],
            [
                'ind_id' => 7,
                'documento' => 'Evidencias de las actividades para fomentar conocimientos y diálogo saberes ancestrales de pueblos y nacionalidades.',
            ],
            [
                'ind_id' => 7,
                'documento' => 'Documento que evidencie el seguimiento y evaluación del plan institucional de igualdad.',
            ],
            [
                'ind_id' => 7,
                'documento' => 'Análisis del aporte de los resultados, producto del seguimiento y evaluación de la aplicación de las políticas de igualdad de oportunidades y del plan de igualdad institucional.',
            ],
            [
                'ind_id' => 8,
                'documento' => 'Normativa interna para el cogobierno.',
            ],
            [
                'ind_id' => 8,
                'documento' => 'Estatuto.',
            ],
            [
                'ind_id' => 8,
                'documento' => 'Documentos que evidencien los procesos de elección de los miembros del cogobierno.',
            ],
            [
                'ind_id' => 8,
                'documento' => 'Evidencias respecto del cumplimiento de los principios de alternabilidad, igualdad de oportunidades y no discriminación.',
            ],
            [
                'ind_id' => 8,
                'documento' => 'Evidencias de cumplimiento de las reuniones del Órgano Colegiado Superior',
            ],
            [
                'ind_id' => 8,
                'documento' => 'Análisis del aporte de los resultados producto del seguimiento y evaluación de la gestión del cogobierno, para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 9,
                'documento' => 'Código de ética.',
            ],
            [
                'ind_id' => 9,
                'documento' => 'Documento que evidencie la instancia(s) responsable(s) correspondiente(s).',
            ],
            [
                'ind_id' => 9,
                'documento' => 'Evidencias de la difusión del código de ética y capacitaciones o actividades de concientización.',
            ],
            [
                'ind_id' => 9,
                'documento' => 'Documentos que evidencien (en caso de existir) las sanciones emitidas a los miembros de la comunidad universitaria, considerando la confidencialidad de la información.',
            ],
            [
                'ind_id' => 9,
                'documento' => 'Documento que evidencie la rendición anual de cuentas.',
            ],
            [
                'ind_id' => 9,
                'documento' => 'Análisis del monitoreo y cumplimiento del código de ética de la institución para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 9,
                'documento' => 'Análisis del aporte de los resultados producto del seguimiento y evaluación sobre los procesos de ética y transparencia para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 10,
                'documento' => 'Modelo educativo vigente suscrito por la instancia correspondiente',
            ],
            [
                'ind_id' => 10,
                'documento' => 'Documento donde se encuentre la filosofía institucional',
            ],
            [
                'ind_id' => 10,
                'documento' => 'Documento(s) que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 10,
                'documento' => 'Documento(s) que evidencie la planificación, monitoreo, mejora o actualización y difusión del modelo educativo',
            ],
            [
                'ind_id' => 10,
                'documento' => 'Documento(s) que evidencie el desarrollo de habilidades blandas en los estudiantes y la aplicación de la relación teoría – práctica',
            ],
            [
                'ind_id' => 10,
                'documento' => 'Documento(s) que evidencie la perspectiva de innovación, sostenibilidad, internacionalización y mecanismos para el uso de inteligencia artificial',
            ],
            [
                'ind_id' => 10,
                'documento' => 'Análisis del aporte de los resultados de la implementación, monitoreo, evaluación, actualización del modelo educativo',
            ],
            [
                'ind_id' => 11,
                'documento' => 'Normativa interna vigente relacionada con proceso de creación y actualización de la oferta académica',
            ],
            [
                'ind_id' => 11,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 11,
                'documento' => 'Modelo educativo o pedagógico vigente suscrito por la instancia correspondiente',
            ],
            [
                'ind_id' => 11,
                'documento' => 'Planificación institucional',
            ],
            [
                'ind_id' => 11,
                'documento' => 'Estatuto de la UEP',
            ],
            [
                'ind_id' => 11,
                'documento' => 'Documento(s) que evidencie el proceso de seguimiento, evaluación, y que sus resultados son considerados en la mejora de la oferta académica',
            ],
            [
                'ind_id' => 11,
                'documento' => 'Documento(s) que evidencie demuestra que la oferta académica considere la demanda social local, nacional y la perspectiva internacional con carácter de innovación permanente, en consecución a los ODS y mecanismos para el uso de inteligencia artificial',
            ],
            [
                'ind_id' => 11,
                'documento' => 'Análisis del seguimiento y evaluación de la oferta académica para la contribución en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 12,
                'documento' => 'Normativa interna para el diseño, actualización o ajustes curriculares',
            ],
            [
                'ind_id' => 12,
                'documento' => 'Informe(s) de gestión de la instancia responsable, que incluya al menos, evidencia de: a. El proceso de seguimiento y evaluación de los planes de estudio. b. La articulación de los proyectos curriculares con el modelo educativo o pedagógico, filosofía y estrategias institucionales y necesidades de la sociedad. c. El cumplimiento de resultados de aprendizaje y la participación de grupos de interés como graduados, sectores profesionales o productivos, entre otros',
            ],
            [
                'ind_id' => 12,
                'documento' => 'Documentos que evidencien el seguimiento y las acciones de mejora',
            ],
            [
                'ind_id' => 12,
                'documento' => 'Análisis del aporte de la gestión curricular y verificación de los resultados de aprendizaje en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 13,
                'documento' => 'Normativa interna que regula al personal académico y personal de apoyo académico de la institución',
            ],
            [
                'ind_id' => 13,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 13,
                'documento' => 'Documento que evidencie la difusión de los procesos de permanencia, capacitación y promoción del personal académico y personal de apoyo académico',
            ],
            [
                'ind_id' => 13,
                'documento' => 'Normativa interna que evidencie los derechos y obligaciones',
            ],
            [
                'ind_id' => 13,
                'documento' => 'Plan o programa de perfeccionamiento del personal académico',
            ],
            [
                'ind_id' => 13,
                'documento' => 'Documento que evidencie la ejecución del plan o programa de perfeccionamiento del personal académico',
            ],
            [
                'ind_id' => 13,
                'documento' => 'Análisis del aporte de los resultados producto del seguimiento y evaluación de los procesos de ingreso, permanencia y promoción del personal académico, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 14,
                'documento' => 'Normativa interna para la evaluación integral del desempeño académico',
            ],
            [
                'ind_id' => 14,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 14,
                'documento' => 'Evidencia(s) de difusión de los propósitos, procedimientos e instrumentos de la evaluación integral',
            ],
            [
                'ind_id' => 14,
                'documento' => 'Evidencia de la evaluación integral de desempeño de todo el personal académico, sus acciones de mejora y perfeccionamiento',
            ],
            [
                'ind_id' => 14,
                'documento' => 'Evidencia(s) de la comunicación de resultados de la evaluación al personal evaluado',
            ],
            [
                'ind_id' => 14,
                'documento' => 'Evidencia(s) de la participación de autoridades, comité evaluador, personal académico y estudiantes',
            ],
            [
                'ind_id' => 14,
                'documento' => 'Análisis del aporte de la evaluación integral del personal académico en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 15,
                'documento' => 'Normativa interna para el perfeccionamiento académico',
            ],
            [
                'ind_id' => 15,
                'documento' => 'Plan anual de perfeccionamiento académico, que considere entre otros: a. Necesidades de formación docente b. Recomendaciones de capacitación resultado del proceso',
            ],
            [
                'ind_id' => 15,
                'documento' => 'Programas de perfeccionamiento académico ejecutados',
            ],
            [
                'ind_id' => 15,
                'documento' => 'Ejecución presupuestaria de los programas de perfeccionamiento',
            ],
            [
                'ind_id' => 15,
                'documento' => 'Evidencia(s) de la difusión del programa de perfeccionamiento académico',
            ],
            [
                'ind_id' => 15,
                'documento' => 'Entrevistas con el personal académico en la visita in situ',
            ],
            [
                'ind_id' => 15,
                'documento' => 'Análisis del aporte de los resultados producto del seguimiento y evaluación de los procesos y programas de perfeccionamiento del personal académico, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 16,
                'documento' => 'Contratos, adendas, nombramientos y/o acciones de personal del profesorado',
            ],
            [
                'ind_id' => 16,
                'documento' => 'Planta docente reportada en el sistema SIIES',
            ],
            [
                'ind_id' => 17,
                'documento' => 'Contratos, adendas, nombramientos y/o acciones de personal académico',
            ],
            [
                'ind_id' => 17,
                'documento' => 'El CACES podrá contrastar información del MDT de acuerdo con la dedicación de los contratos para la validación de la información reportada',
            ],
            [
                'ind_id' => 17,
                'documento' => 'Personal académico reportado en el sistema SIIES',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Normativa interna para admisión y nivelación o acompañamiento académico',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Documentos que evidencien la aplicación de políticas, programas o planes de acción para la igualdad de oportunidades y no discriminación',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Documentos que evidencien la planificación, ejecución y seguimiento de los procesos de admisión y nivelación o acompañamiento académico',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Documentos que evidencien mecanismos o recursos utilizados para los procesos de admisión y nivelación o acompañamiento académico y sus estrategias de mejoras',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Documentos que evidencien el desarrollo e implementación de estrategias que contribuyen al principio de integralidad',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Reporte o informe(s) de permanencia estudiantil de grado y posgrado. a. Los datos de permanencia se contrastarán con la información anual reportada de estudiantes en la plataforma informática correspondiente',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Documento que evidencie la implementación de acciones y estrategias que contribuyan a disminuir la deserción estudiantil',
            ],
            [
                'ind_id' => 18,
                'documento' => 'Análisis del aporte producto del seguimiento y evaluación de los procesos de admisión, nivelación, acompañamiento académico, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 19,
                'documento' => 'Información de estudiantes matriculados en las cohortes que iniciansus estudios reportada en el SIIES',
            ],
            [
                'ind_id' => 19,
                'documento' => 'Información de estudiantes matriculados en el período de evaluación',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Normativa interna para el proceso de titulación',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Evidencias de la difusión de la normativa interna de titulación',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Documentos que evidencien la planificación, ejecución y seguimiento de los procesos de titulación',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Documentos que evidencien la asignación de tutores de acuerdo con las necesidades del estudiante',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Reporte o informe(s) de los resultados de la titulación estudiantil',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Evidencias de las acciones de mejora en los procesos de titulación estudiantil, con base en los resultados del seguimiento y evaluación',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Evidencias de los mecanismos y estrategias implementadas con los estudiantes que terminaron su plan de estudios para motivar su titulación',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Información de estudiantes titulados reportada en la plataforma informática destinada para el efecto',
            ],
            [
                'ind_id' => 20,
                'documento' => 'Análisis de la contribución de los procesos de acompañamiento a los estudiantes en su titulación para el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 21,
                'documento' => 'Información de estudiantes y graduados con fecha de graduación reportada en el SIIES',
            ],
            [
                'ind_id' => 21,
                'documento' => 'Información de duración de carreras y programas reportada en el SIIES',
            ],
            [
                'ind_id' => 21,
                'documento' => 'Información de estudiantes matriculados en las cohortes iniciadas del periodo de evaluación reportada en el SIIES',
            ],
            [
                'ind_id' => 22,
                'documento' => 'Información de estudiantes y graduados con fecha de graduación reportada en el SIIES',
            ],
            [
                'ind_id' => 22,
                'documento' => 'Información de duración de programas reportada en el SIIES',
            ],
            [
                'ind_id' => 22,
                'documento' => 'Información de estudiantes matriculados en las cohortes iniciadas en',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Reporte o Informe de seguimiento a graduados que incluya información e indicadores de empleabilidad, emprendimiento y continuidad de estudios',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Evidencias respecto a la difusión de los resultados del seguimiento a graduados',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Documentos que evidencien la información obtenida de los graduados en actividades institucionales académicas y no académicas',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Evidencias sobre implementación de estrategias de inserción laboral de sus graduados',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Evidencias de participación de graduados en redes de conocimiento e innovación',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Documento que evidencie las mejoras implementadas en el proceso de seguimiento a graduados',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Documento que evidencie la mejora o actualización del perfil de egreso u oferta académica con base en los resultados del sistema de seguimiento a graduados',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Verificación in situ del sistema de seguimiento a graduados 25',
            ],
            [
                'ind_id' => 23,
                'documento' => 'Análisis del aporte del seguimiento a los graduados en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Normativa interna de la investigación e innovación',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Normativa interna que regula el comportamiento ético de la comunidad universitaria en los procesos de investigación',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Plan de investigación e innovación',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Programas o proyectos de investigación e innovación reportados en el SIIES. a. Utilizados para la mejora de Docencia o Vinculación. b. Relacionados a líneas de investigación, dominios académicos, necesidades del entorno y los Objetivos de Desarrollo Sostenible (ODS). c. Relacionados a pueblos y nacionalidades indígenas, afroecuatorianos, pueblo montubio y otros.d. Participación de profesores o profesores y estudiantes. e. En relación con centros de transferencia de tecnología f. En relación con proyectos de Docencia o Vinculación de ser el caso.',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Documentos que evidencien la planificación, ejecución, seguimiento, evaluación, difusión e implementación de acciones de mejora de investigación',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Documento que evidencie el presupuesto asignado y ejecutado a investigación e innovación',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Evidencias de mecanismos para obtener fondos o recursos externos',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Documento que evidencie un plan de estímulos relacionados a los resultados de investigación e innovación',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Evidencien la participación de profesores o profesores y estudiantes',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Documentos que evidencien la cooperación interinstitucional (nacional o internacional)',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Convenios u otros instrumentos legales en ejecución para la participación en redes y cooperación interinstitucional',
            ],
            [
                'ind_id' => 24,
                'documento' => 'Análisis del aporte de la política y planificación de investigación e innovación en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 25,
                'documento' => 'Programas de investigación reportados en el SIIES',
            ],
            [
                'ind_id' => 25,
                'documento' => 'Proyectos de investigación reportados en el SIIES',
            ],
            [
                'ind_id' => 25,
                'documento' => 'Convenios de cooperación interinstitucional u otros instrumentos legales',
            ],
            [
                'ind_id' => 25,
                'documento' => 'Evidencias sobre el financiamiento externo',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Artículos publicados en revistas de las bases de datos Scopus o Web of Science',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Artículos publicados en revistas de las bases de datos regionales según el anexo 1',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Artículos publicados en revistas de la base de datos Latindex catálogo 2.0',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Artículos publicados en actas de congresos indexados (Proceedings) en bases de datos Scopus o Web of Science',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Libros publicados en el periodo de evaluación revisados por pares',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Capítulos de libros publicados en el periodo de evaluación revisados por pares',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Documentos que evidencien la revisión por pares del libro o capítulo del libro',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Planta docente reportada en el sistema SIIES',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Documentos que evidencien la evaluación por curadores o expertos anónimos y externos a la institución donde trabaja el autor',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Documentos que evidencien haber expuesto o presentado la producción artística en eventos, exposiciones nacionales o internacionales o de haber ganado premios, dentro o fuera del país',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Evidencia de la propiedad intelectual',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Proyecto de investigación, vinculación o de producción artística al cual pertenece el producto de propiedad intelectual',
            ],
            [
                'ind_id' => 26,
                'documento' => 'Registro de derechos de autor en el SENADI',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Normativa interna de vinculación con la sociedad',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Documentos que evidencien la planificación, seguimiento, evaluación, y acciones de mejora de los programas o proyectos de vinculación con la sociedad',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Documentos que evidencien la asignación y participación de personal académico o personal de apoyo académico y estudiantes en los procesos de vinculación con la sociedad',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Documentos donde se evidencie la participación de los actores internos y externos en la identificación de necesidades de intervención o en los diagnósticos participativos',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Programas y/o proyectos ejecutados o en ejecución e iniciativas de interés público planificados de acuerdo con las líneas de operativas establecidas por la institución',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Convenios u otros instrumentos en ejecución o ejecutados con los sectores productivos, públicos y privados, así como con organizaciones sociales',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Programas o proyectos de vinculación con la sociedad que promuevan la equidad y la justicia hacia pueblos, nacionalidades e interculturalidad, género, personas con discapacidad y ambiente',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Documento que evidencie la asignación y ejecución presupuestaria para la vinculación con la sociedad',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Evidencias de actividades de divulgación del conocimiento académico',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Programas o proyectos de incubación de emprendimientos innovadores, aceleradoras, hábitat de empresas innovadoras, articulados con sus dominios académicos o líneas de investigación o vinculación',
            ],
            [
                'ind_id' => 27,
                'documento' => 'Análisis de la gestión de la Vinculación con la Sociedad en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 28,
                'documento' => 'Planes, programas o proyectos de vinculación con la sociedad que incluyan actividades de investigación y docencia',
            ],
            [
                'ind_id' => 28,
                'documento' => 'Documentos que evidencien la asignación de personal académico y participación de estudiantes',
            ],
            [
                'ind_id' => 28,
                'documento' => 'Documentos que evidencien los resultados de los proyectos de vinculación utilizados en actividades o proyectos de investigación',
            ],
            [
                'ind_id' => 28,
                'documento' => 'Programas o proyectos de vinculación con la sociedad desarrollados a partir de resultados obtenidos de actividades o proyectos de investigación',
            ],
            [
                'ind_id' => 28,
                'documento' => 'Programas o proyectos de vinculación con la sociedad desarrollados a partir de resultados obtenidos de actividades o proyectos de docencia',
            ],
            [
                'ind_id' => 28,
                'documento' => 'Documentos que evidencien el seguimiento y acciones de mejora',
            ],
            [
                'ind_id' => 28,
                'documento' => 'Análisis del aporte de los procesos de articulación de la Vinculación con la Sociedad con la Docencia y la Investigación en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 29,
                'documento' => 'Proyectos de vinculación con la sociedad reportados en el SIIES.',
            ],
            [
                'ind_id' => 29,
                'documento' => 'Oferta académica vigente y en ejecución reportada en el SIIES',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Normativa interna que describa el sistema de gestión de la calidad institucional para el aseguramiento de la calidad considerando el modelo educativo y filosofía institucional',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente.',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Plan estratégico de desarrollo institucional',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Informe(s) de autoevaluación institucional con su plan de mejora',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Documento que evidencie la planificación y seguimiento de los procesos de autoevaluación de carreras, programas, sedes y extensiones',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Informe(s) de autoevaluación de carreras, programas, sedes y extensiones con sus planes de mejora',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Evidencias de mejoras realizadas con base en resultados del seguimiento monitoreo y administración de información de procesos académicos y no académicos',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Evidencia(s) de la participación de la comunidad universitaria para articular prioridades, examinar la alineación de sus propósitos y recursos para el aseguramiento de la calidad',
            ],
            [
                'ind_id' => 30,
                'documento' => 'Análisis del aporte de los resultados producto del seguimiento de los procesos de Aseguramiento de la Calidad Institucional en la mejora continua',
            ],
            [
                'ind_id' => 31,
                'documento' => 'Normativa interna para el proceso de autoevaluación institucional',
            ],
            [
                'ind_id' => 31,
                'documento' => 'Documento que evidencie la instancia responsable correspondiente',
            ],
            [
                'ind_id' => 31,
                'documento' => 'Documentos que evidencien la planificación, ejecución y evaluación del proceso de autoevaluación. • De asignación de recursos (humanos, tecnológicos, logísticos financieros, entre otros) • De información utilizada para el proceso de autoevaluación institucional • De participación de la comunidad universitaria en el proceso de autoevaluación institucional',
            ],
            [
                'ind_id' => 31,
                'documento' => 'Informe de autoevaluación institucional',
            ],
            [
                'ind_id' => 31,
                'documento' => 'Documentos que avalen la participación y/o formación de personal académico en procesos de evaluación internos o externos',
            ],
            [
                'ind_id' => 31,
                'documento' => 'Plan de mejora del proceso de autoevaluación institucional',
            ],
            [
                'ind_id' => 31,
                'documento' => 'Plan estratégico de desarrollo institucional',
            ],
            [
                'ind_id' => 31,
                'documento' => 'Análisis del aporte de los procesos de autoevaluación en el aseguramiento de la calidad institucional y de la mejora continua',
            ],
            [
                'ind_id' => 32,
                'documento' => 'Normativa interna que contemple el desarrollo y ejecución de planes de mejora',
            ],
            [
                'ind_id' => 32,
                'documento' => 'Plan de mejora institucional',
            ],
            [
                'ind_id' => 32,
                'documento' => 'Planes de mejora de carreras, programas o unidades académicas y de sedes y extensiones',
            ],
            [
                'ind_id' => 32,
                'documento' => 'Plan estratégico de desarrollo institucional',
            ],
            [
                'ind_id' => 32,
                'documento' => 'Documentos que evidencien el seguimiento y ejecución de los planes de mejora, así como de su análisis para el aporte en el aseguramiento de la calidad',
            ],
            [
                'ind_id' => 32,
                'documento' => 'Análisis del aporte de los resultados, obtenidos en el seguimiento y evaluación de los planes de mejoramiento, para el aseguramiento de la calidad y de la mejora continua',
            ],
        ];

        foreach ($fuentes_informacion as $fuente_informacion) {
            FuenteInformacion::create($fuente_informacion);
        }
    }
}
