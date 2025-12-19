<?php

namespace Database\Seeders;

use App\Models\ElementoFundamental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElementoFundamentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementos = [
            [
                'ind_id' => 1,
                'elemento' => 'La institución cuenta con una planificación estratégica y operativa que articula la misión y visión institucional, las funciones sustantivas de acuerdo con su oferta de grado y posgrado, los procesos administrativos, considera la planificación nacional y el Objetivo de Desarrollo Sostenible (ODS) correspondiente a educación de calidad.',
            ],
            [
                'ind_id' => 1,
                'elemento' => 'La institución cuenta con una planificación estratégica y operativa de carreras, programas o unidades académicas y de sus sedes y extensiones, articuladas a la planificación estratégica institucional.',
            ],
            [
                'ind_id' => 1,
                'elemento' => 'La instancia responsable coordina prioridades, plazos y recursos para su ejecución considerando los resultados de los procesos de aseguramiento de la calidad.',
            ],
            [
                'ind_id' => 1,
                'elemento' => 'La institución realiza procesos de seguimiento y evaluación continua de la planificación estratégica y operativa para conocer el estado y avance de las metas y objetivos. Cuenta con indicadores de cumplimiento y los resultados son considerados en la toma de decisiones.',
            ],
            [
                'ind_id' => 1,
                'elemento' => 'La planificación estratégica y operativa se construye a través de procesos participativos y los informes de su ejecución son difundidos y conocidos por la comunidad universitaria.',
            ],
            [
                'ind_id' => 1,
                'elemento' => 'La institución analiza el aporte de los resultados, producto del seguimiento y evaluación de la planificación estratégica y operativa, en el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 2,
                'elemento' => 'La institución aplica su normativa interna que orienta la planificación, ejecución, seguimiento y evaluación de los procesos de bienestar universitario, bajo la coordinación de una instancia responsable.',
            ],
            [
                'ind_id' => 2,
                'elemento' => 'La institución dispone de procedimientos que permiten brindar orientación vocacional y profesional, bienestar emocional, ayudas económicas o becas a estudiantes, acciones afirmativas asociadas o no a la discapacidad, y a estudiantes que pertenezcan a grupos históricamente vulnerables y otros servicios que la institución considere pertinentes.',
            ],
            [
                'ind_id' => 2,
                'elemento' => 'La institución dispone de servicios, brinda o cuenta con convenios para el cuidado y bienestar infantil, servicios de salud básicos a la comunidad universitaria y un seguro de accidentes para los estudiantes en el marco de la normativa vigente.',
            ],
            [
                'ind_id' => 2,
                'elemento' => 'La institución cuenta con normativa interna, ejecuta estrategias y protocolos, para la seguridad y convivencia pacífica en las actividades universitarias, así como, el respeto a los derechos y a la integridad física, psicológica y sexual de toda la comunidad universitaria promoviendo un ambiente libre de todas las formas de acoso y violencia, en el marco de la normativa vigente.',
            ],
            [
                'ind_id' => 2,
                'elemento' => 'La institución cuenta con mecanismos que fomentan el desarrollo de las actividades extracurriculares tales como culturales, artísticas y deportivas, entre otras, por parte de los integrantes de la comunidad universitaria.',
            ],
            [
                'ind_id' => 2,
                'elemento' => 'La institución implementa programas o proyectos de información, prevención, control y conciencia del uso de drogas, bebidas alcohólicas, cigarrillos y derivados del tabaco, así como del fenómeno socioeconómico de las drogas.',
            ],
            [
                'ind_id' => 2,
                'elemento' => 'La institución cuenta con un sistema integral de información que, permite llevar registros, expedientes, entre otros procesos de gestión relacionados con el bienestar universitario.',
            ],
            [
                'ind_id' => 2,
                'elemento' => 'La institución realiza el seguimiento de todos los servicios de bienestar universitario y analiza el aporte de los resultados en el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 3,
                'elemento' => 'La institución aplica su normativa interna a través de una instancia responsable que, planifica, ejecuta y da seguimiento al desarrollo de estrategias para la movilidad de la comunidad universitaria y la internacionalización institucional.',
            ],
            [
                'ind_id' => 3,
                'elemento' => 'La institución cuenta con convenios, acuerdos u otros instrumentos de gestión vigentes y en ejecución para el desarrollo de la movilidad de la comunidad universitaria que permiten el acceso a programas académicos o de intercambio científico-tecnológico con instituciones nacionales o internacionales.',
            ],
            [
                'ind_id' => 3,
                'elemento' => 'La institución promueve el proceso de internacionalización a través de convenios u otros instrumentos de integración con otras instituciones, redes o comunidades académicas internacionales de investigación o vinculación, o procesos de acreditación, certificación de sus carreras y programas.',
            ],
            [
                'ind_id' => 3,
                'elemento' => 'La institución analiza el aporte de los resultados, producto del seguimiento y evaluación de los procesos de internacionalización y movilidad, en el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución cuenta con una instancia responsable de la planificación de su infraestructura física y tecnológica para garantizar el desarrollo de las funciones sustantivas y adjetivas.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución cuenta con presupuesto asignado para la construcción, mantenimiento y equipamiento de la infraestructura física y tecnológica.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución dispone de infraestructura física, propia o a través de convenios u otros mecanismos, accesible para el desarrollo de las funciones sustantivas y actividades no académicas como deportivas, artísticas, culturales o recreacionales.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución cuenta con sistemas informáticos de gestión integrados, accesibles, seguros y fiables para el desarrollo de las funciones sustantivas y actividades no académicas que permitan generar reportes y evidencias para su gestión.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución cuenta con sistemas informáticos de gestión académica y no académica, integrados, accesibles, seguros y fiables que permitan generar reportes, evidencias y trazabilidad.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución cuenta con condiciones de accesibilidad universal en todas las instalaciones físicas, recursos tecnológicos o demuestra esta accesibilidad a través de acciones y estrategias. Además, coordina con el Consejo Nacional para la Igualdad de Discapacidades para implementar requerimientos de accesibilidad universal.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución realiza revisión periódica y mantenimiento de la infraestructura física y tecnológica para garantizar su funcionalidad y soporte a las actividades académicas y no académicas.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución cuenta con ambientes de aprendizaje presenciales o virtuales para el desarrollo de las actividades académicas contando con los recursos tecnológicos-pedagógicos necesarios.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución cuenta con normativa interna y una instancia responsable que ejecuta estrategias que previenen los riesgos de seguridad y salud ocupacional de la comunidad universitaria.',
            ],
            [
                'ind_id' => 4,
                'elemento' => 'La institución analiza cómo las condiciones institucionales, recursos, infraestructura, accesibilidad aportan en el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 5,
                'elemento' => 'La biblioteca cuenta con personal especializado para el desarrollo de sus actividades y dispone de normativa interna que regula su funcionamiento.',
            ],
            [
                'ind_id' => 5,
                'elemento' => 'La biblioteca desarrolla mecanismos o procedimientos para la integración de los recursos bibliográficos institucionales en redes nacionales o internacionales de intercambio, colaboración o circulación.La biblioteca desarrolla mecanismos o procedimientos para la integración de los recursos bibliográficos institucionales en redes nacionales o internacionales de intercambio, colaboración o circulación.',
            ],
            [
                'ind_id' => 5,
                'elemento' => 'La biblioteca cuenta con acervo bibliográfico físico o digital relacionado con la oferta académica y cuenta con un proceso de actualización bibliográfico con base en los requerimientos de la comunidad académica.',
            ],
            [
                'ind_id' => 5,
                'elemento' => 'La biblioteca desarrolla procesos permanentes de monitoreo, medición y evaluación integral del uso y calidad de los servicios bibliotecarios cuyos resultados se analizan para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 5,
                'elemento' => 'La infraestructura de la biblioteca garantiza la movilidad y el acceso al acervo bibliográfico físico y digital en el marco de los principios de igualdad de oportunidades y no discriminación.',
            ],
            [
                'ind_id' => 5,
                'elemento' => 'La institución dispone de sistemas informáticos para la gestión de la biblioteca.',
            ],
            [
                'ind_id' => 5,
                'elemento' => 'La institución realiza el monitoreo y evaluación de la calidad de los servicios bibliotecarios y analiza como los resultados aportan para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 6,
                'elemento' => 'La institución aplica la normativa interna que regula los procesos del Sistema de Gestión Documental y Archivo, bajo la coordinación de una instancia responsable que planifica, ejecuta, da seguimiento, evalúa e implementa acciones de mejora sobre los procesos de la gestión documental y archivo.',
            ],
            [
                'ind_id' => 6,
                'elemento' => 'La institución dispone de recursos tecnológicos y de talento humano formado o capacitado técnicamente para la gestión de documentos y archivos físicos, digitales o electrónicos.',
            ],
            [
                'ind_id' => 6,
                'elemento' => 'La institución cuenta o ha contratado el servicio o posee otros instrumentos, para el almacenamiento, organización, conservación, preservación, digitalización, sistematización y difusión de su patrimonio documental físico o digital en sus fases intermedia e histórica.',
            ],
            [
                'ind_id' => 6,
                'elemento' => 'La institución aplica herramientas técnico-archivísticas para la clasificación, selección, descripción y disposición de los documentos en soporte físico, digital o electrónico, así como, el de carácter histórico.',
            ],
            [
                'ind_id' => 6,
                'elemento' => 'La institución utiliza sistemas automatizados que apoyen la tramitología institucional, la digitalización, la descripción y control documental, así como la generación y almacenamiento de documentos digitales o electrónicos.',
            ],
            [
                'ind_id' => 6,
                'elemento' => 'La institución realiza el seguimiento y evalúa los procesos del Sistema de Gestión Documental y Archivo, y analiza su aporte en el aseguramiento de la calidad para la mejora continua.',
            ],
            [
                'ind_id' => 7,
                'elemento' => 'La institución, aplica normativa interna y un plan institucional de igualdad que responde a las necesidades de la comunidad universitaria.',
            ],
            [
                'ind_id' => 7,
                'elemento' => 'La institución desarrolla estrategias de acción afirmativa que promueven la igualdad de oportunidades e interculturalidad en la comunidad universitaria, con base en su normativa interna.',
            ],
            [
                'ind_id' => 7,
                'elemento' => 'La institución desarrolla estrategias para fomentar la inclusión de grupos vulnerables e históricamente excluidos, así como para la prevención de la violencia de género.',
            ],
            [
                'ind_id' => 7,
                'elemento' => 'La institución desarrolla estrategias y actividades para fomentar el conocimiento y diálogo de saberes ancestrales de pueblos y nacionalidades en el marco del principio de interculturalidad.',
            ],
            [
                'ind_id' => 7,
                'elemento' => 'La institución analiza el aporte de los resultados, producto del seguimiento y evaluación de la aplicación de las políticas de igualdad de oportunidades y del plan de igualdad institucional, en el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 8,
                'elemento' => 'La institución aplica normativa interna articulada a su filosofía institucional que, define la estructura del cogobierno institucional, su organización, integración, deberes y atribuciones.',
            ],
            [
                'ind_id' => 8,
                'elemento' => 'La institución garantiza y ejecuta procesos transparentes de elección de profesores, estudiantes, empleados y trabajadores a los organismos colegiados de cogobierno, acorde con principios de calidad, alternabilidad e igualdad de oportunidades y no discriminación.',
            ],
            [
                'ind_id' => 8,
                'elemento' => 'La institución garantiza el cumplimiento de deberes y derechos de la comunidad universitaria a través del cogobierno.',
            ],
            [
                'ind_id' => 8,
                'elemento' => 'El órgano colegiado superior se reúne de manera periódica acorde a su normativa interna.',
            ],
            [
                'ind_id' => 8,
                'elemento' => 'La institución analiza el aporte de los resultados producto del seguimiento y evaluación de la gestión del cogobierno, para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 9,
                'elemento' => 'La institución, en el marco de su filosofía institucional, aplica un código de ética propio que regula el comportamiento de los miembros de la comunidad universitaria en el desarrollo de las funciones sustantivas y procesos no académicos, bajo la coordinación de una instancia responsable.',
            ],
            [
                'ind_id' => 9,
                'elemento' => 'La institución difunde el código de ética a su comunidad universitaria y desarrolla estrategias como capacitaciones y actividades de concientización para fomentar la práctica de valores institucionales y ciudadanos en la comunidad universitaria.',
            ],
            [
                'ind_id' => 9,
                'elemento' => 'El código de ética especifica las sanciones a su incumplimiento por parte de la comunidad universitaria.',
            ],
            [
                'ind_id' => 9,
                'elemento' => 'La institución presenta a la comunidad universitaria la rendición anual de cuentas en el marco del cumplimiento de su filosofía, objetivos y planificación institucional.',
            ],
            [
                'ind_id' => 9,
                'elemento' => 'La institución da seguimiento y evalúa el cumplimiento del comportamiento ético a la comunidad universitaria y sus resultados se consideran para la mejora continua.',
            ],
            [
                'ind_id' => 9,
                'elemento' => 'La institución analiza el aporte de los resultados producto del seguimiento y evaluación sobre los procesos de ética y transparencia para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 10,
                'elemento' => 'El modelo educativo se encuentra articulado a la filosofía institucional y enmarcado en la normativa del sistema de educación superior',
            ],
            [
                'ind_id' => 10,
                'elemento' => 'El modelo educativo orienta la actividad académica, acorde a sus dominios académicos y a las modalidades de educación ofertadas',
            ],
            [
                'ind_id' => 10,
                'elemento' => 'La institución cuenta con una instancia responsable dedicada a la planificación, implementación, monitoreo, evaluación, mejora o actualización y difusión del modelo educativo',
            ],
            [
                'ind_id' => 10,
                'elemento' => 'El modelo educativo contempla las funciones sustantivas de docencia, investigación y vinculación con la sociedad, con una perspectiva de innovación, sostenibilidad, internacionalización y mecanismos para el uso de inteligencia artificial',
            ],
            [
                'ind_id' => 10,
                'elemento' => 'El modelo educativo considera el desarrollo de habilidades blandas en los estudiantes y la relación teoría-práctica',
            ],
            [
                'ind_id' => 10,
                'elemento' => 'La institución analiza el aporte de los resultados, producto de la implementación, monitoreo, evaluación, actualización de su modelo educativo, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 11,
                'elemento' => 'La institución aplica normativa interna enmarcada en los principios del sistema de educación superior (SES) para establecer un proceso de creación, actualización y cierre de carreras y programas bajo la coordinación de una instancia responsable',
            ],
            [
                'ind_id' => 11,
                'elemento' => 'La institución cuenta con un proceso de seguimiento y evaluación de la oferta académica cuyos resultados se consideran para la implementación de acciones de mejora',
            ],
            [
                'ind_id' => 11,
                'elemento' => 'El proceso de creación y actualización de carreras o programas demuestra que la oferta académica considere la demanda social local, nacional y la perspectiva internacional con carácter de innovación permanente',
            ],
            [
                'ind_id' => 11,
                'elemento' => 'Los planes de estudio contemplan el uso adecuado de mecanismos o herramientas de inteligencia artificial',
            ],
            [
                'ind_id' => 11,
                'elemento' => 'El proceso de creación o actualización de carreras o programas demuestra que la oferta académica se corresponda con la planificación institucional, filosofía institucional y con el modelo educativo o pedagógico',
            ],
            [
                'ind_id' => 11,
                'elemento' => 'El proceso de creación o actualización de carreras o programas demuestra que la oferta académica considera las tendencias del mercado ocupacional local, nacional e internacional, propicia currículos flexibles y toma en cuenta las modalidades de enseñanza',
            ],
            [
                'ind_id' => 11,
                'elemento' => 'La institución analiza el aporte de los resultados del seguimiento y evaluación de la oferta académica, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 12,
                'elemento' => 'La institución aplica normativa interna vigente, a través de una instancia(s) responsable(s) de los procesos de diseño, actualización y ajustes curriculares, así como para el seguimiento, evaluación y retroalimentación de los planes de estudio',
            ],
            [
                'ind_id' => 12,
                'elemento' => 'Los procesos de diseño, actualización y ajustes curriculares, basados en actividades de seguimiento y evaluación de su oferta académica, demuestran que los proyectos curriculares se articulan con el modelo educativo o pedagógico, filosofía y planificación estratégica institucional y con las necesidades de la sociedad',
            ],
            [
                'ind_id' => 12,
                'elemento' => 'La institución ejecuta procesos de revisión curricular periódica, con la participación de académicos internos o externos a la institución y con grupos de interés como graduados, sectores profesionales o productivos, entre otros, para la implementación de acciones de mejora',
            ],
            [
                'ind_id' => 12,
                'elemento' => 'La institución evalúa el cumplimiento de los resultados de aprendizaje en función del perfil de egreso y cuenta con la participación de grupos de interés como graduados, sectores profesionales o productivos, entre otros, para la implementación de acciones de mejora',
            ],
            [
                'ind_id' => 12,
                'elemento' => 'La institución analiza el aporte de la gestión curricular y la verificación de los resultados de aprendizaje, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 13, 
                'elemento' => 'La institución aplica normativa interna con la cual desarrolla procesos de selección, vinculación, permanencia, capacitación, y promoción del personal académico y apoyo de académico, enmarcados en las normas que rigen el sistema de educación superior. La instancia responsable correspondiente demuestra que respeta los principios de igualdad de oportunidades y no discriminación',
            ],
            [
                'ind_id' => 13, 
                'elemento' => 'La institución desarrolla y ejecuta procesos de titularización del personal académico de conformidad con su planificación estratégica, normativa interna y las normas que rigen el sistema de educación superior',
            ],
            [
                'ind_id' => 13, 
                'elemento' => 'La institución difunde los procesos de ingreso, permanencia, capacitación y promoción al personal académico y personal de apoyo académico. Además, realiza el seguimiento a estos procesos para evaluar e implementar acciones de mejora',
            ],
            [
                'ind_id' => 13, 
                'elemento' => 'La institución considera para la vinculación del personal académico el perfil profesional y formación académica afín al campo de conocimiento o a las asignaturas a impartir. Además, experiencia docente en la modalidad de enseñanza o práctica laboral relacionada al campo de conocimiento, de requerirse',
            ],
            [
                'ind_id' => 13, 
                'elemento' => 'La institución considera para la vinculación del personal de apoyo académico los requisitos establecidos en la normativa institucional y del sistema de educación superior',
            ],
            [
                'ind_id' => 13, 
                'elemento' => 'La institución cuenta con una normativa interna que define los derechos, obligaciones y el comportamiento ético que debe seguir el personal académico y de apoyo académico en las actividades de docencia, investigación, vinculación, cogobierno y gestión educativa, considerando el principio de igualdad de oportunidades y no discriminación',
            ],
            [
                'ind_id' => 13, 
                'elemento' => 'La institución desarrolla programas de perfeccionamiento para el personal académico, con base en una normativa interna y en las necesidades institucionales',
            ],
            [
                'ind_id' => 13, 
                'elemento' => 'La institución analiza el aporte de los resultados producto del seguimiento y evaluación de los procesos de ingreso, permanencia y promoción del personal académico, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 14, 
                'elemento' => 'La institución aplica normativa interna para la evaluación integral del desempeño del personal académico, de conformidad a la normativa aplicable en materia de educación superior',
            ],
            [
                'ind_id' => 14, 
                'elemento' => 'La institución difunde entre el personal académico los propósitos, procedimientos e instrumentos de la evaluación integral del desempeño',
            ],
            [
                'ind_id' => 14, 
                'elemento' => 'La institución aplica periódicamente la evaluación integral del desempeño a todo el personal académico, con base en su normativa interna y bajo la coordinación de la instancia responsable',
            ],
            [
                'ind_id' => 14, 
                'elemento' => 'La institución con base en los resultados de la evaluación del desempeño del personal académico aplica la normativa interna para el perfeccionamiento del personal académico, genera mecanismos y estrategias para la mejora de su desempeño',
            ],
            [
                'ind_id' => 14, 
                'elemento' => 'El proceso de evaluación integral del desempeño se desarrolla con la participación de todos los actores institucionales (autoridades, personal académico y estudiantes) y sus resultados son comunicados al personal evaluado',
            ],
            [
                'ind_id' => 14, 
                'elemento' => 'La institución analiza el aporte de la evaluación integral del personal académico en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 15, 
                'elemento' => 'La institución aplica su normativa interna, a través de una instancia responsable que planifica, ejecuta, evalúa, implementa acciones de mejora y difunde los programas de perfeccionamiento',
            ],
            [
                'ind_id' => 15, 
                'elemento' => 'La institución establece y ejecuta un presupuesto institucional para el desarrollo de programas de perfeccionamiento',
            ],
            [
                'ind_id' => 15, 
                'elemento' => 'La institución desarrolla programas de formación, capacitación y actualización que considera el área de conocimiento, las tecnologías educativas y didáctico-pedagógicas, entre otras en la que se desempeña el personal académico',
            ],
            [
                'ind_id' => 15, 
                'elemento' => 'La institución analiza el aporte de los resultados producto del seguimiento y evaluación de los procesos y programas de perfeccionamiento del personal académico, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 18, 
                'elemento' => 'La institución desarrolla procesos de admisión y nivelación para sus aspirantes y acompañamiento académico para los estudiantes, considerando el principio de igualdad de oportunidades y no discriminación, con base en la normativa institucional y del sistema de educación superior, bajo la coordinación de una instancia responsable',
            ],
            [
                'ind_id' => 18, 
                'elemento' => 'La instancia responsable planifica, ejecuta y da seguimiento a los procesos de admisión y nivelación o acompañamiento académico; además, dispone de recursos humanos, tecnológicos, financieros u otros para su ejecución',
            ],
            [
                'ind_id' => 18, 
                'elemento' => 'La institución cuenta con políticas de seguimiento y acompañamiento de la trayectoria académica de los estudiantes que asegure su permanencia movilidad y egreso',
            ],
            [
                'ind_id' => 18, 
                'elemento' => 'La institución desarrolla estrategias que contribuyen al cumplimiento del principio de integralidad',
            ],
            [
                'ind_id' => 18, 
                'elemento' => 'La institución dispone de información sobre la tasa de permanencia de sus estudiantes tanto de grado como de posgrado y la utiliza para implementar acciones y/o estrategias de mejora que contribuyan a disminuir la deserción estudiantil',
            ],
            [
                'ind_id' => 18, 
                'elemento' => 'La institución analiza el aporte producto del seguimiento y evaluación de los procesos de admisión, nivelación, acompañamiento académico, en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 20, 
                'elemento' => 'La institución aplica su normativa interna, en el marco del sistema de educación superior y el principio de igualdad de oportunidades, que establece procedimientos, requisitos académicos y administrativos, así como las opciones y plazos de titulación para los estudiantes de grado y posgrado, la cual es difundida',
            ],
            [
                'ind_id' => 20, 
                'elemento' => 'La institución cuenta con una instancia responsable que planifica, ejecuta y da seguimiento a los procesos de titulación y sus resultados se consideran para la mejora del proceso',
            ],
            [
                'ind_id' => 20, 
                'elemento' => 'La institución cuenta con un proceso para la designación de un director, tutor y/o docente que guía y acompaña el proceso de titulación de acuerdo con las necesidades del estudiante',
            ],
            [
                'ind_id' => 20, 
                'elemento' => 'La institución implementa mecanismos y estrategias para que los estudiantes que terminaron su plan de estudios culminen el proceso de titulación',
            ],
            [
                'ind_id' => 20, 
                'elemento' => 'La institución analiza la contribución de los procesos de acompañamiento a los estudiantes en su titulación para el aseguramiento de la calidad y mejora continua.',
            ],
            [
                'ind_id' => 23, 
                'elemento' => 'La institución cuenta con un sistema de seguimiento de graduados bajo la coordinación de una instancia responsable que gestiona información e indicadores sobre empleabilidad, emprendimiento y continuidad de estudios. Los resultados son difundidos a su comunidad universitaria',
            ],
            [
                'ind_id' => 23, 
                'elemento' => 'La institución utiliza la información de seguimiento a graduados para la retroalimentación del proceso de enseñanza – aprendizaje y como insumo para la mejora y actualización del perfil de egreso u oferta académica',
            ],
            [
                'ind_id' => 23, 
                'elemento' => 'La institución desarrolla actividades académicas y no académicas en las que involucra a sus graduados para la retroalimentación y actualización de contenidos, análisis de tendencias académicas, laborales, investigativas y tecnológicas, entre otras',
            ],
            [
                'ind_id' => 23, 
                'elemento' => 'La institución cuenta con una bolsa de empleo o similares y desarrolla estrategias que permiten la inserción laboral de sus graduados en el sector laboral nacional o internacional',
            ],
            [
                'ind_id' => 23, 
                'elemento' => 'La institución analiza el aporte del seguimiento a graduados, para el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'La institución aplica normativa interna que define los objetivos, lineamientos procedimientos para realizar investigación e innovación y con una instancia responsable que planifica, ejecuta, da seguimiento, evalúa e implementa acciones de mejora',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'La institución asigna y ejecuta presupuesto según lo establecido en la normativa de educación superior y dispone de mecanismos para obtener fondos o recursos externos que garanticen el desarrollo de los objetivos inherentes a las actividades de investigación',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'La institución considera en la planificación de la investigación, la generación y difusión de conocimiento en temas relacionados a las artes, ciencias, saberes, conocimientos, tecnologías, pedagogías, así como lenguas, ontologías y epistemologías de los pueblos y nacionalidades indígenas, afroecuatorianos y pueblo montubio, entre otras, con base en la autonomía responsable',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'La institución cuenta con una normativa interna que regula el comportamiento ético de la comunidad universitaria en los procesos de investigación',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'Los programas o proyectos de investigación e innovación se desarrollan en el marco de las líneas de investigación, dominios académicos, necesidades del entorno o los Objetivos de Desarrollo Sostenible (ODS)',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'La institución demuestra que los resultados de investigación aportan a la docencia y a la vinculación',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'La institución dispone de un plan de estímulos relacionados a los resultados generados por la investigación e innovación.',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'Los programas o proyectos de investigación e innovación cuentan con la participación de profesores o profesores y estudiantes, en el marco de los principios de igualdad de oportunidades y no discriminación',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'Los programas y proyectos de investigación e innovación en cooperación interinstitucional (nacional o internacional) se realizan sobre la base de convenios u otros instrumentos legales',
            ],
            [
                'ind_id' => 24, 
                'elemento' => 'La institución analiza cómo la política y planificación de investigación e innovación aporta en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'La institución aplica normativa interna que define el alcance y el accionar de la vinculación con la sociedad y sus líneas operativas declaradas, bajo la coordinación de una instancia responsable que planifica, integra, ejecuta, da seguimiento, evalúa e implementa acciones de mejora',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'La normativa interna de vinculación con la sociedad está en concordancia con la normativa de educación superior, la misión, visión, objetivos, modelo educativo, dominios académicos de la institución y responde a la planificación de la política pública, así como a los Objetivos de Desarrollo Sostenible (ODS)',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'La institución demuestra la participación de personal académico, personal de apoyo académico y estudiantes, bajo los principios de igualdad de oportunidades y no discriminación',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'La institución desarrolla planes, programas, proyectos e iniciativas de interés público de acuerdo con sus líneas operativas establecidas, que cuentan con un diagnóstico y con la participación de actores involucrados',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'La institución desarrolla procesos de cooperación interinstitucional mediante la gestión de convenios u otros instrumentos legales, con sectores organizacionales, institucionales, empresariales, comunitarios, públicos o privados, nacionales o internacionales, relacionados a sus dominios académicos',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'La institución desarrolla programas o proyectos de vinculación con la sociedad en el ámbito de las artes, ciencias, saberes, conocimientos tecnologías, pedagogías, así como lenguas, ontologías y epistemologías de los pueblos y nacionalidades indígenas, afroecuatorianos y pueblo montubio, entre otras, con base en la autonomía responsable',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'La institución asigna y ejecuta un presupuesto específico con recursos propios o gestiona recursos externos para el desarrollo de la vinculación con la sociedad',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'Los resultados de programas o proyectos de investigación y vinculación son divulgados a través de la organización de seminarios, congresos, foros, espacios de innovación social entre otros, con la participación de profesores y estudiantes',
            ],
            [
                'ind_id' => 27, 
                'elemento' => 'La institución analiza cómo la gestión de la Vinculación con la Sociedad aporta en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 28, 
                'elemento' => 'La institución desarrolla planes, programas o proyectos de vinculación con la sociedad que incluyen actividades de investigación y docencia, bajo la coordinación de personal académico y participación de estudiantes',
            ],
            [
                'ind_id' => 28, 
                'elemento' => 'La institución desarrolla planes, programas o proyectos de vinculación con la sociedad cuyos resultados son utilizados para el desarrollo de actividades o proyectos de investigación',
            ],
            [
                'ind_id' => 28, 
                'elemento' => 'La institución desarrolla planes, programas o proyectos de vinculación con la sociedad considerando los resultados obtenidos de actividades o proyectos de investigación',
            ],
            [
                'ind_id' => 28, 
                'elemento' => 'La institución desarrolla planes, programas o proyectos de vinculación con la sociedad considerando los resultados obtenidos de actividades o proyectos de docencia',
            ],
            [
                'ind_id' => 28, 
                'elemento' => 'La institución da seguimiento y evalúa las actividades y proyectos de articulación entre las funciones sustantivas y sus resultados se consideran para la mejora continua',
            ],
            [
                'ind_id' => 28, 
                'elemento' => 'La institución analiza cómo los procesos de articulación de la Vinculación con la Sociedad con la Docencia y la Investigación aportan en el aseguramiento de la calidad y mejora continua',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'La institución cuenta con un sistema de gestión para el aseguramiento de la calidad institucional, considerando el modelo educativo, filosofía institucional y normativas que rigen el sistema de educación superior como el principio de calidad',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'El sistema de aseguramiento de la calidad contempla la autoevaluación institucional para el análisis y medición de los procesos relacionados con las actividades académicas y no académicas, y sus resultados son usados para la mejora continua',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'La institución cuenta con una instancia responsable que planifica, implementa y evalúa los procesos de aseguramiento de la calidad y sus acciones de mejora, a través de instrumentos establecidos por la institución',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'La normativa interna del aseguramiento de la calidad contempla la gestión de calidad de todas sus sedes y extensiones. La planificación, ejecución, monitoreo y seguimiento de procesos de autoevaluación de sedes y extensiones aportan a la mejora continua de la Institución',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'La normativa interna del aseguramiento de la calidad contempla la gestión de calidad de carreras y programas. La planificación, ejecución, monitoreo y seguimiento de procesos de autoevaluación de carreras o grupos de carreras, así como de programas o grupo de programas aportan a la mejora continua de la Institución',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'Todas las carreras y programas que han sido evaluadas por el CACES deberán estar acreditadas',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'La institución obtiene datos y procesa información para la toma de decisiones que contribuyan al aseguramiento de la calidad',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'La institución promueve la participación de la comunidad universitaria en procesos de reflexión y planificación para articular prioridades, examinar la alineación de sus propósitos y recursos en relación con el aseguramiento de la calidad',
            ],
            [
                'ind_id' => 30, 
                'elemento' => 'La institución analiza el aporte de la ejecución de los procesos de Aseguramiento de la Calidad Institucional en la mejora continua',
            ],
            [
                'ind_id' => 31, 
                'elemento' => 'La institución aplica normativa interna enmarcada en los principios del sistema de educación superior, donde se describen los procedimientos para el proceso de autoevaluación institucional que incluye a sus sedes y extensiones',
            ],
            [
                'ind_id' => 31, 
                'elemento' => 'La institución cuenta con una instancia responsable que planifica, ejecuta y evalúa el proceso de autoevaluación institucional y dispone de recursos (humanos, tecnológicos, logísticos, financieros, entre otros) que garanticen la efectividad del proceso',
            ],
            [
                'ind_id' => 31, 
                'elemento' => 'El proceso de autoevaluación institucional utiliza información cualitativa y cuantitativa para la mejora de los procesos académicos y no académicos',
            ],
            [
                'ind_id' => 31, 
                'elemento' => 'La institución desarrolla la autoevaluación institucional periódicamente, como un proceso colaborativo y reflexivo con la participación de la comunidad universitaria',
            ],
            [
                'ind_id' => 31, 
                'elemento' => 'La institución promueve la participación y formación de su personal académico en procesos de evaluación internos y externos',
            ],
            [
                'ind_id' => 31, 
                'elemento' => 'El proceso de autoevaluación identifica fortalezas, debilidades y oportunidades de mejora, a través del análisis de los procesos académicos y no académicos',
            ],
            [
                'ind_id' => 31, 
                'elemento' => 'La institución desarrolla un plan de mejora alineado a la planificación estratégica con base en los resultados del proceso de autoevaluación de los diferentes ámbitos institucionales',
            ],
            [
                'ind_id' => 31, 
                'elemento' => 'La institución analiza el aporte de los procesos de autoevaluación en el aseguramiento de la calidad institucional y de la mejora continua',
            ],
            [
                'ind_id' => 32, 
                'elemento' => 'La institución aplica su normativa interna para el desarrollo del plan de mejoras producto de autoevaluaciones institucionales, de carreras o programas y de sedes y extensiones o evaluaciones externas de organismos o agencias nacionales o internacionales',
            ],
            [
                'ind_id' => 32, 
                'elemento' => 'La institución implementa el plan de mejora articulado a la planificación estratégica de la institución, así como a su filosofía institucional',
            ],
            [
                'ind_id' => 32, 
                'elemento' => 'El plan de mejora contiene: acciones, responsables, cronograma fuentes de información o evidencias para el cumplimiento y recursos o presupuesto, en caso de requerirlo, que permitan implementarlo con efectividad logrando la mejora continua de la institución',
            ],
            [
                'ind_id' => 32, 
                'elemento' => 'La institución realiza el seguimiento periódico al plan de mejoras,constata su ejecución para la toma de decisiones y determina el aporte al aseguramiento de la calidad de la institución',
            ],
            [
                'ind_id' => 32, 
                'elemento' => 'La institución analiza el aporte de los resultados obtenidos en el seguimiento y evaluación de los planes de mejoramiento para el aseguramiento de la calidad y de la mejora continua',
            ],
        ];

        foreach ($elementos as $elementoData) {
            ElementoFundamental::create($elementoData);
        }
    }
}
