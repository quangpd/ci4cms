<?php

namespace Blog\Controllers;

use \App\Libraries\Breadcrumb;

class AdminController extends \App\Controllers\BaseController
{
    protected $data = [];
    protected $breadcumbs;

    public function __construct()
    {
        $this->data['title'] = 'Blog Admin';
        $this->data['page_title'] = 'Blog Admin Content';

        $this->breadcumbs = new Breadcrumb();
        $this->breadcumbs->add('Home', '')->add('Admin', 'admin')->add('Manage Blog', 'blog');

        $this->data['breadcumbs'] = $this->breadcumbs->render();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            $response = ['success' => 1];
            $limit = $this->request->getPost('length');
            $sortField = $this->request->getPost('field') ?? 'id';
            $sortOrder = $this->request->getPost('dir') ?? 'asc';

            $model = new \Blog\Models\ArticleModel();

            $data['items'] = $model->orderBy($sortField, $sortOrder)->paginate($limit);

            $response['page']['links'] = $model->pager->links('default', 'default_bootstrap5');
            $response['page']['total_rows'] = $model->pager->getDetails()['total'];
            $response['page']['start_row'] = ($model->pager->getCurrentPage() - 1) * $limit;
            $response['page']['end_row'] = $model->pager->getCurrentPage() * $limit >  $response['page']['total_rows'] ?  $response['page']['total_rows'] : $model->pager->getCurrentPage() * $limit;
            $response['rows'] = view('Blog\Views\admin\rows', $data);

            return $this->response->setJSON($response);
        }


        return view('Blog\Views\admin\index', $this->data);
    }

    public function form($id = NULL)
    {
        # code...
    }

    public function featured($id = NULL)
    {
        if ($this->request->isAJAX()) {
            $model = new \Blog\Models\ArticleModel();
            $id_array = (!empty($id)) ? array($id) : $this->request->getPost('action_to');

            if (!empty($id_array)) {
                foreach ($id_array as $id) {
                    $item = $model->find($id);
                    $model->update($id, ['is_featured' => $item->is_featured ? 0 : 1]);
                }
            }

            $response = ['success' => 1];
            return $this->response->setJSON($response);
        }
    }

    public function private($id = NULL)
    {
        if ($this->request->isAJAX()) {
            $model = new \Blog\Models\ArticleModel();
            $id_array = (!empty($id)) ? array($id) : $this->request->getPost('action_to');

            if (!empty($id_array)) {
                foreach ($id_array as $id) {
                    $item = $model->find($id);
                    $model->update($id, ['is_privated' => $item->is_privated ? 0 : 1]);
                }
            }

            $response = ['success' => 1];
            return $this->response->setJSON($response);
        }
    }

    public function active($id = NULL)
    {
        if ($this->request->isAJAX()) {
            $model = new \Blog\Models\ArticleModel();
            $id_array = (!empty($id)) ? array($id) : $this->request->getPost('action_to');

            if (!empty($id_array)) {
                foreach ($id_array as $id) {
                    $item = $model->find($id);
                    $data['status'] = $item->status ? 0 : 1;
                    $model->update($id, $data);
                }
            }

            $response = ['success' => 1];
            return $this->response->setJSON($response);
        }
    }

    public function delete($id = NULL)
    {
        if ($this->request->isAJAX()) {
            $model = new \Blog\Models\ArticleModel();

            $id_array = (!empty($id)) ? array($id) : $this->request->getPost('action_to');

            if (!empty($id_array)) {
                foreach ($id_array as $id) {
                    $model->delete($id);
                }
            }

            $response = ['success' => 1];
            return $this->response->setJSON($response);
        }
    }
}
