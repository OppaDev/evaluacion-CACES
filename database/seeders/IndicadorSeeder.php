<?php

namespace Database\Seeders;

use App\Models\Indicador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndicadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicadores = [
            ['sub_cri_id' => '1','sub_id' => '1', 'indicador' => 'INDICADOR 1: PLANIFICACIÓN INSTITUCIONAL', 'estandar' => 'La institución cuenta con planificación estratégica y operativa en el marco de su misión, visión, modelo educativo o pedagógico, estatuto vigente, así como de los principios de autonomía responsable, pertinencia, entre otros que rigen el Sistema de Educación Superior (SES). A través de la planificación estratégica se articulan las funciones sustantivas y los procesos administrativos. La instancia responsable ejecuta procesos de monitoreo y evaluación y sus resultados son considerados para la toma de decisiones encaminadas a la mejora continua institucional.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación'],
            ['sub_cri_id' => '1','sub_id' => '1', 'indicador' => 'INDICADOR 2: BIENESTAR UNIVERSITARIO', 'estandar' => 'La institución aplica su normativa a través de una instancia responsable que garantiza el bienestar de la comunidad universitaria, desarrollando procesos de: orientación vocacional y profesional; bienestar emocional; acciones afirmativas; ayudas económicas o becas; servicios de salud y actividades recreativas; de gestión y prevención de riesgos, u otros que la institución promueva, en el marco del respeto, igualdad de oportunidades y prevención de violencia; ejecuta procesos de monitoreo y evaluación de la calidad de los servicios y los resultados son considerados para la mejora continua.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '1','sub_id' => '1', 'indicador' => 'INDICADOR 3: INTERNACIONALIZACIÓN Y MOVILIDAD', 'estandar' => 'La institución aplica su normativa interna a través de una instancia responsable que, permita desarrollar estrategias para el posicionamiento institucional a nivel internacional y realizar actividades de movilidad académica nacional e internacional, intercambio de conocimientos académicos, artísticos, científicos o tecnológicos, en beneficio de la comunidad universitaria. Además, ejecuta procesos de monitoreo y evaluación de la calidad de las actividades y los resultados son considerados para la mejora continua.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '1','sub_id' => '2', 'indicador' => 'INDICADOR 4: INFRAESTRUCTURA FÍSICA Y TECNOLÓGICA', 'estandar' => 'La institución planifica y cuenta con infraestructura física y tecnológica integrada, pertinente y accesible para desarrollar las funciones sustantivas y actividades no académicas. Además, monitorea y evalúa la funcionalidad de estos recursos para la mejora continua.', 'periodo' => 'Los periodos académicos concluidos en el último año previo al proceso de evaluación.'],
            ['sub_cri_id' => '1','sub_id' => '2', 'indicador' => 'INDICADOR 5: GESTIÓN DE BIBLIOTECAS', 'estandar' => 'La biblioteca contribuye al desarrollo de las funciones sustantivas, provee de un acervo bibliográfico físico o digital relacionado con la oferta académica, bajo la regulación de normativa interna. Forma parte de redes nacionales o internaciones de intercambio y acceso compartido de recursos bibliotecarios. Ejecuta procesos de monitoreo, medición, evaluación integral del uso y calidad de los servicios, los resultados se consideran para la mejora continua.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '1','sub_id' => '2', 'indicador' => 'INDICADOR 6: GESTIÓN DOCUMENTAL Y DE ARCHIVO', 'estandar' => 'La institución cuenta con un Sistema de Gestión Documental y Archivo y dispone de recursos físicos, tecnológicos y humanos para el almacenamiento, organización, conservación, disposición y difusión de documentos físicos, digitales o electrónicos de los procesos generados en la institución. Además, cuenta con una instancia responsable que planifica, ejecuta, da seguimiento, evalúa e implementa acciones de mejora.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '1','sub_id' => '3', 'indicador' => 'INDICADOR 7: IGUALDAD DE OPORUNIDADES E INTERCULTURALIDAD', 'estandar' => 'La institución, en el marco de su autonomía responsable, implementa procesos para garantizar la igualdad de oportunidades e interculturalidad; realiza seguimiento y evaluación para la mejora continua de estos procesos.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '1','sub_id' => '3', 'indicador' => 'INDICADOR 8: COGOBIERNO', 'estandar' => 'La institución, en el marco de su autonomía responsable, aplica una normativa interna articulada con su filosofía institucional y con la del sistema de educación superior, que define la estructura del cogobierno institucional, promueve la participación de los profesores, estudiantes y personal administrativo bajo los principios de calidad, alternabilidad, igualdad de oportunidades y no discriminación. Además, se ejecutan procesos de seguimiento y evaluación de la gestión del cogobierno para la mejora continua.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '1','sub_id' => '3', 'indicador' => 'INDICADOR 9: ÉTICA Y TRANSPARENCIA', 'estandar' => 'La institución aplica normas de conducta ética articuladas con la filosofía institucional que promueven un comportamiento transparente, inclusivo y respetuoso de los miembros de la comunidad universitaria, guiando sus actuaciones. Fomentan valores institucionales y ciudadanos, bajo la coordinación de una instancia responsable, que ejecuta procesos de seguimiento, evaluación e implementa acciones de mejora continua.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            [
                'cri_id' => '2',
                'indicador' => 'INDICADOR 10: MODELO EDUCATIVO',
                'estandar' => 'El modelo educativo aprobado y vigente se encuentra articulado a la filosofía institucional y a la normativa del sistema de educación superior. Este modelo orienta las funciones sustantivas con una perspectiva de innovación, sostenibilidad e internacionalización; así como, la modalidad de estudios, el desarrollo de habilidades blandas en los estudiantes y la relación teoría-práctica. Además, cuenta con una instancia responsable encargada de planificar, implementar, evaluar, mejorar y realizar su difusión.',
                'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'
            ],
            [
                
                'cri_id' => '2',
                'indicador' => 'INDICADOR 11: OFERTA ACADÉMICA',
                'estandar' => 'La institución ejecuta procesos para la creación, actualización o cierre de carreras o programas para garantizar que la oferta académica responda a la demanda social local, nacional e internacional, con carácter de innovación permanente. Este proceso considera currículos flexibles, las modalidades de enseñanza, las tendencias del mercado ocupacional nacional e internacional, la planificación institucional y mecanismos para el uso de inteligencia artificial. Además, ejecuta actividades de monitoreo y evaluación del proceso de creación o actualización de carreras o programas, y sus resultados son considerados para la mejora continua de la oferta académica.',
                'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'
            ],
            [
                
                'cri_id' => '2',
                'indicador' => 'INDICADOR 12: GESTIÓN CURRICULAR Y RESULTADOS DE APRENDIZAJE',
                'estandar' => 'La institución aplica procesos de diseño, actualización y ajustes curriculares de manera periódica, con base en los resultados del seguimiento y evaluación de los planes de estudio y resultados de aprendizaje, en función del perfil de egreso, con la finalidad de asegurar la articulación de la oferta académica con el Plan estratégico de desarrollo institucional y las necesidades de la sociedad.',
                'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'
            ],
            ['sub_cri_id' => '3', 'sub_id' => '4', 'indicador' => 'INDICADOR 13: PROCESOS DE INGRESO, PERMANENCIA Y PROMOCIÓN', 'estandar' => 'La institución aplica una normativa que regula los procesos relacionados con el personal académico y de apoyo académico, enmarcada en las políticas del sistema de educación superior y que respeta los principios de igualdad de oportunidades y no discriminación. Los procesos de ingreso, permanencia y promoción son difundidos, se desarrollan con base en el perfil profesional, experiencia docente afín a la asignatura, a la modalidad de enseñanza o a la práctica laboral en su disciplina. Sus resultados se consideran para la mejora continua. Además, cuenta y aplica una normativa que describe los derechos, obligaciones y el comportamiento ético que debe seguir el personal académico y de apoyo académico, así como, su participación en órganos directivos de la institución.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '3', 'sub_id' => '4', 'indicador' => 'INDICADOR 14: EVALUACIÓN INTEGRAL DEL PERSONAL ACADÉMICO', 'estandar' => 'La institución realiza la evaluación integral del desempeño del personal académico bajo el marco normativo vigente, institucional y del sistema de educación superior. La evaluación se lleva a cabo con el apoyo de una instancia responsable que utiliza los resultados para el desarrollo de acciones de mejora al desempeño del personal académico. El proceso de evaluación integral se desarrolla con la participación de los actores institucionales correspondientes y sus resultados son comunicados al personal académico.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '3', 'sub_id' => '4', 'indicador' => 'INDICADOR 15: PERFECCIONAMIENTO ACADÉMICO', 'estandar' => 'La institución aplica una normativa para la actualización, capacitación o formación del personal académico bajo la coordinación de una instancia responsable la cual planifica, ejecuta, evalúa e implementa acciones de mejora a los programas de perfeccionamiento, en el marco de la innovación, el área de conocimiento, las tecnologías educativas y las didáctico-pedagógicas, considerando el resultado de la evaluación integral de desempeño.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '3', 'sub_id' => '4', 'indicador' => 'INDICADOR 16: PERSONAL ACADÉMICO CON FORMACIÓN DOCTORAL', 'estandar' => '', 'periodo' => ''],
            ['sub_cri_id' => '3', 'sub_id' => '4', 'indicador' => 'INDICADOR 17: PERSONAL ACADÉMICO CON DEDICACIÓN A TIEMPO COMPLETO', 'estandar' => 'La institución cuenta con una tasa del personal académico con dedicación a tiempo completo de al menos el 50% en cada periodo académico.', 'periodo' => 'Los periodos académicos concluidos en el año previo al inicio del proceso de evaluación.'],
            [ 'sub_cri_id' => '3','sub_id' => '5', 'indicador' => 'INDICADOR 18: ASPIRANTES Y ESTUDIANTES', 'estandar' => 'La institución aplica una normativa que regula los procesos de admisión de aspirantes y de nivelación o acompañamiento académico, la cual, considera el principio de integralidad, igualdad de oportunidades y no discriminación; cuenta con los recursos necesarios para ejecutar dichos procesos y los resultados de su seguimiento y evaluación se considera en el mejoramiento de estos procesos. Además, desarrolla un sistema de seguimiento y acompañamiento sobre la trayectoria estudiantil que asegure su permanencia, movilidad y egreso.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            [ 'sub_cri_id' => '3','sub_id' => '5', 'indicador' => 'INDICADOR 19: TASA DE DESERCIÓN INSTITUICONAL DE SEGUNDO AÑO-OFERTA ACADEMICA DE GRADO', 'estandar' => 'La institución cuenta con una tasa promedio de deserción de estudiantes de grado al segundo año de máximo el 14%.', 'periodo' => 'Periodos académicos concluidos tres años antes del inicio del proceso de evaluación.'],
            [ 'sub_cri_id' => '3','sub_id' => '5', 'indicador' => 'INDICADOR 20: PROCESO DE TITULACIÓN', 'estandar' => 'La institución aplica una normativa para la gestión de los procesos de titulación en el marco del modelo educativo o pedagógico y de la normativa de educación superior vigente y es difundida entre los estudiantes. Cuenta con una instancia responsable que planifica, ejecuta y evalúa los procesos implementados, cuyos resultados son considerados para la mejora continua de los procesos de titulación.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previos al inicio del proceso de evaluación.'],
            [ 'sub_cri_id' => '3','sub_id' => '5', 'indicador' => 'INDICADOR 21: TASA DE TITULACIÓN INSTITUCIONAL-OFERTA ACADÉMICA DE GRADO', 'estandar' => 'La institución cuenta con una tasa promedio de titulación institucional de la oferta académica de grado de al menos el 50%.', 'periodo' => 'Corresponde al tiempo máximo de duración de las carreras de la UEP más un año adicional antes del inicio del proceso de evaluación.'],
            [ 'sub_cri_id' => '3','sub_id' => '5', 'indicador' => 'INDICADOR 22: TASA DE TITULACIÓN-OFERTA DE POSGRADO', 'estandar' => 'La institución cuenta con una tasa promedio de titulación institucional de la oferta académica de posgrado de al menos el 82%.', 'periodo' => 'Corresponde al tiempo máximo de duración de los programas de la UEP más un año adicional antes del inicio del proceso de evaluación.'],
            ['sub_cri_id' => '3', 'sub_id' => '5', 'indicador' => 'INDICADOR 23: SEGUIMIENTO A GRADUADOS', 'estandar' => 'La institución cuenta con un sistema de seguimiento a graduados bajo la coordinación de una instancia responsable que gestiona información e indicadores sobre la empleabilidad pertinente, emprendimiento y continuidad de estudios. Utiliza los resultados del seguimiento como insumo para la revisión y actualización del perfil de egreso y mejora del sistema de seguimiento. Además, cuenta con una bolsa de empleo que contribuye a la inserción laboral de sus graduados.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '4','sub_id' => '6', 'indicador' => 'INDICADOR 24: POLÍTICA Y PLANIFICACIÓN DE INVESTIGACIÓN E INNOVACIÓN', 'estandar' => 'La institución aplica una normativa que define el accionar de la investigación e innovación, bajo una instancia responsable que planifica, ejecuta, da seguimiento, evalúa e implementa acciones de mejora. La planificación de la investigación se realiza acorde a la planificación institucional, las líneas de investigación, los dominios académicos y al análisis del entorno y cuenta con una asignación presupuestaria. En el desarrollo de la investigación se consideran las artes, las ciencias, saberes, conocimientos, tecnologías, pedagogías, así como lenguas, ontologías y epistemologías de los pueblos y nacionalidades indígenas, afroecuatorianos y pueblo montubio, entre otras, con base en la autonomía responsable.', 'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'],
            ['sub_cri_id' => '4','sub_id' => '6', 'indicador' => 'INDICADOR 25: PROYECTOS DE INVESTIGACIÓN E INNOVACIÓN CON FINANCIAMIENTO EXTERNO O EN RED', 'estandar' => 'La institución cuenta con proyectos de investigación e innovación concluidos o en ejecución con financiamiento externo o con participación en redes internacionales o nacionales. Se espera que al menos el 40% de los proyectos de investigación e innovación concluidos o en ejecución cuenten con financiamiento externo o con participación en redes internacionales o nacionales.', 'periodo' => 'Los tres años concluidos antes del inicio del proceso de evaluación.'],
            ['sub_cri_id' => '4','sub_id' => '7', 'indicador' => 'INDICADOR 26: PRODUCCIÓN ACADÉMICA', 'estandar' => 'La institución cuenta con producción académica como resultado de sus procesos de investigación. Se espera que el índice de producción académica per cápita sea de al menos 1,5 en 3 años.', 'periodo' => 'Tres años concluidos antes del inicio del proceso de evaluación.'],
            [
                
                'cri_id' => '5',
                'indicador' => 'INDICADOR 27: GESTIÓN DE LA VINCULACIÓN CON LA SOCIEDAD',
                'estandar' => 'La institución aplica una normativa interna que regula el accionar de la vinculación con la sociedad, bajo la coordinación de una instancia responsable que planifica, ejecuta, evalúa, realiza seguimiento e implementa acciones de mejora y divulga los resultados obtenidos de los planes, programas, proyectos e iniciativas de interés público, relacionados con la oferta académica y las líneas operativas establecidas.',
                'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'
            ],
            [
                
                'cri_id' => '5',
                'indicador' => 'INDICADOR 28: ARTICULACIÓN DE LA VINCULACIÓN CON LA SOCIEDAD CON LA DOCENCIA E INVESTIGACIÓN',
                'estandar' => 'La institución establece planes, programas o proyectos e iniciativas de interés público de vinculación que promueven la articulación con la docencia e investigación. Realiza el seguimiento y evalúa los resultados que son considerados para la mejora continua.',
                'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'
            ],
            [
                
                'cri_id' => '5',
                'indicador' => 'INDICADOR 29: PROYECTOS DE VINCULACIÓN CON LA SOCIEDAD',
                'estandar' => 'La institución cuenta con proyectos de vinculación de acuerdo con su oferta académica. Se espera un mínimo de 1,5 proyectos de vinculación por carrera y programa con resultados verificables totales o parciales.',
                'periodo' => 'Los tres años concluidos antes del inicio del proceso de evaluación.'
            ],
            [
                
                'cri_id' => '6',
                'indicador' => 'INDICADOR 30: ASEGURAMIENTO DE LA CALIDAD INSTITUCIONAL',
                'estandar' => 'La institución cuenta con un sistema de gestión para el aseguramiento de la calidad basado en su filosofía institucional, el mismo que aporta al desarrollo de sus procesos académicos y administrativos, a la consecución de resultados y responde a las necesidades de la comunidad universitaria. Además, dispone de una instancia responsable que planifica, implementa y evalúa los procesos de aseguramiento de la calidad y sus acciones de mejora.',
                'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'
            ],
            [
                
                'cri_id' => '6',
                'indicador' => 'INDICADOR 31: AUTOEVALUACIÓN INSTITUCIONAL',
                'estandar' => 'La institución aplica una normativa interna para realizar procesos de autoevaluación institucional periódicos, basados en el análisis crítico, reflexivo y participativo, para identificar sus fortalezas y debilidades y plantear acciones de mejora continua en el contexto del aseguramiento interno de la calidad.',
                'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.'
            ],
            [
                                
                'cri_id' => '6',
                'indicador' => 'INDICADOR 32: PLAN DE MEJORA INSTITUCIONAL',
                'estandar' => 'La institución implementa un plan de mejoras, resultado de la aplicación de los procesos de autoevaluación o evaluación externa de organismos nacionales o internacionales. Cuenta con una instancia responsable que da seguimiento y evalúa la ejecución del plan para la mejora continua.',
                'periodo' => 'Los periodos académicos concluidos en los últimos dos años y seis meses previo al inicio del proceso de evaluación.',
            ],
        ];

        foreach ($indicadores as $indicador) {
            Indicador::create($indicador);
        }
    }
}
