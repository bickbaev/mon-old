<?php

class StatController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

	}

        public function filters()
        {
            return array(
                'accessControl + index, ajaxFillTree, prov, sogl, prin, dorab'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
                $this->render('tree');
        }

        public function actionAjaxFillTree()
        {
            // если пробуют получить прямой доступ к экшину (не через ajax)
            // тогда обрубаем "крылья")) т.е. возвращаем белую страницу

            if (!Yii::app()->request->isAjaxRequest) {
                exit();
            }

            // с какого узла начинаем вывод дерева? 0 - с первого
            if (isset($_GET['root']) && $_GET['root'] != 'source') {
                // переменная $_GET['root'] говорит нам о том, по какому узлу в дереве
                // кликнули. Исходя из этого получаем данные детей (подкатегорий)
                $id = (int) $_GET['root'];
                $req = Yii::app()->db->createCommand('
                    select
                    id_rep_type as id,
                    rep_name as text,
                    id_rep_type is null as hasChildren,
                    rep_mv as otchet,
                    DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date,
                    DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date
                    from rep_name
                    where rep_type = '.$id.'
                    order by
                    id_rep_type ASC
                ');
            }
            else {
                $req = Yii::app()->db->createCommand('
                    select
                    rep_type.rep_type as id,
                    rep_type.rep_type_name as text,
                    rep_name.id_rep_type is not null as hasChildren
                    from
                    rep_type INNER JOIN rep_name
                    on
                    rep_name.rep_type = rep_type.rep_type
                    where rep_type.stat is null
                    group by
                    rep_type.rep_type_name
                    order by
                    rep_name.id_rep_type ASC
                ');
            }
            // сам запрос на получение данных детей (через обычный LEFT JOIN)
            $children = $req->queryAll();
            if(isset($children[0]['s_date'])) {
                for($n = 0; $n < sizeof($children); $n++) {
                    $children[$n]['text'] = CHtml::link($children[$n]['text'].' ('.$children[$n]['s_date'].' - '.$children[$n]['f_date'].')', 'index.php?r=statistica/'.$children[$n]['otchet'].'/index&id_rep_type='.$children[$n]['id']);
                }
            }
            // возвращаем данные
            echo str_replace(
                '"hasChildren":"0"',
                '"hasChildren":false',
                CTreeView::saveDataAsJson($children)
            );
            exit();
        }

}