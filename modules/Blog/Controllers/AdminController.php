<?php

namespace Blog\Controllers;

use \App\Libraries\Breadcrumb;

class AdminController extends \App\Controllers\BaseController
{
    private $_rules = array(
        array('field' => 'category_id', 'label' => 'Danh mục', 'rules' => 'trim'),
        array('field' => 'title', 'label' => 'Tiêu đề', 'rules' => 'trim|required|min_length[3]|max_length[255]'),
        array('field' => 'description', 'label' => 'Mô tả', 'rules' => 'trim'),
        array('field' => 'content', 'label' => 'Nội dung', 'rules' => 'trim|required'),
        array('field' => 'image', 'label' => 'Hình ảnh', 'rules' => 'trim'),
        array('field' => 'file', 'label' => 'file', 'rules' => 'trim'),
        array('field' => 'tags', 'label' => 'Tags', 'rules' => 'trim'),
        array('field' => 'status', 'label' => 'Trạng thái', 'rules' => 'trim'),
        array('field' => 'author', 'label' => 'Tác giả', 'rules' => 'trim'),
        array('field' => 'source', 'label' => 'Nguồn', 'rules' => 'trim'),
        array('field' => 'published_at', 'label' => 'Xuất bản', 'rules' => 'trim'),
        array('field' => 'meta_keywords', 'label' => 'Meta keywords', 'rules' => 'trim'),
        array('field' => 'meta_description', 'label' => 'Meta description', 'rules' => 'trim'),
        array('field' => 'is_featured', 'label' => 'Nổi bật', 'rules' => 'trim'),
        array('field' => 'is_privated', 'label' => 'Nội bộ', 'rules' => 'trim'),
        array('field' => 'layout', 'label' => 'layout', 'rules' => 'trim'),
        array('field' => 'template', 'label' => 'template', 'rules' => 'trim'),
    );

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
        if ($this->request->isAJAX()) {
            $model = new \Blog\Models\ArticleModel();
            $this->data['item'] = $id ? $model->asObject()->find($id) : $model->getEmptyItem();

            foreach ($this->_rules as $field) {
                $this->data['item']->{$field['field']} = $this->data['item']->{$field['field']} ?? "";
            }

            $response['success'] = 1;
            $response['id'] = $id;
            $response['html'] = view('\Blog\admin\form', $this->data, ['saveData' => true]);

            return $this->response->setJSON($response);
        }
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
