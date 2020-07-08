<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
  public function __construct($service, $request)
  {
    $this->service = $service;
    $this->request = $request;
  }

  /**
   * Overide this function and make it return true, if current module is a submodule (nested one). (compulsory if current module is submodule)
   * for example: Posts Module = /users/:users_id/posts
   * @returns {boolean}
   */
  public function isSubModule()
  {
    return false;
  }

  /**
   * @params id -> id of the module (for example: users_id)
   * @returns {void}
   */
  public function setModuleId($id)
  {
    if ($this->isSubModule()) {
      $this->moduleId = $id;
    }
  }

  /**
   * Get current module name
   * @returns {string}
   * Override this function (compulsory)
   */
  public function moduleName()
  {
    return '';
  }

  /**
   * Get current sub module name
   * @returns {string}
   * Override this function (compulsory if current module is submodule)
   */
  public function subModuleName()
  {
    return '';
  }

  /**
   * Get view folder for current module
   * @returns {string}
   * Override this function (compulsory)
   */
  public function viewFolder()
  {
    return '';
  }

  /**
   * Convert module name into title by capitalizing each word
   * @returns {string}
   */
  public function moduleToTitle()
  {
    $title = "";
    $data = explode('-', $this->moduleName());
    foreach ($data as $d) {
      $title .= $d . ' ';
    }
    return ucwords($title);
  }

  /**
   * Convert submodule name into title by capitalizing each word
   * @returns {string}
   */
  public function subModuleToTitle()
  {
    $title = "";
    $data = explode('-', $this->subModuleName());
    foreach ($data as $d) {
      $title .= $d . ' ';
    }
    return ucwords($title);
  }


  // Breadcrumb for dashboard page
  public static function breadcrumbBase()
  {
    return [
      "title" => 'Dashboard',
      "link" =>  '/' . PREFIX . '/home',
    ];
  }

  /**
   *
   * @param activate -> weather to activate the title or not
   * @returns {*[]}
   */
  public function breadcrumbForIndex($activate = true)
  {
    $breadcrumbs = [
      $this->breadcrumbBase(),
      [
        "title" => $this->moduleToTitle(),
        "link" => $this->indexUrl(),
        "active" => $this->isSubModule() ? false : $activate,
      ],
    ];
    if ($this->isSubModule()) {
      $breadcrumbs = [
        [
          "title" => $this->subModuleToTitle(),
          "link" => $this->subModuleIndexUrl(),
          "active" => $activate,
        ],
      ];
    }
    return $breadcrumbs;
  }

  /**
   * Breadcrumb for form pages
   * @param title -> create/edit
   * @returns {*[]}
   */
  public function breadcrumbForForm($title)
  {
    return array_merge($this->breadcrumbForIndex(false), [
      [
        "title" => $title,
        "active" =>  true,
      ]
    ]);
  }

  public function getUrl()
  {
    return $this->isSubModule() ? $this->subModuleIndexUrl() : $this->indexUrl();
  }

  public function getModuleName()
  {
    return $this->isSubModule() ? $this->subModuleToTitle() : $this->moduleToTitle();
  }
  /**
   * Get index url for current module
   * @returns {string}
   */
  public function indexUrl()
  {
    return '/' . PREFIX . '/' . $this->moduleName();
  }

  /**
   * Get index url for current sub module
   * @returns {string}
   */
  public function subModuleIndexUrl()
  {
    return $this->indexUrl() . '/' . $this->moduleId . '/' . $this->subModuleName();
  }

  public function renderView($viewFile, $data)
  {
    $data['indexUrl'] = $this->getUrl();
    $data['title'] =  $this->getModuleName();
    return view($this->viewFolder() . '.' . $viewFile, $data)->render();
  }

  /**
   * Show a list of all resources.
   * GET resources
   *
   */
  public function index(Request $request, $id = "")
  {
    $data = $this->service->indexPageData($request);
    $data['breadcrumbs'] = $this->breadcrumbForIndex();
    $this->setModuleId($id);
    return $this->renderView('index', $data);
  }

  /**
   * Render a form to be used for creating a new resource.
   * GET resources/create
   *
   */
  public function create(Request $request, $id = "")
  {
    $data = $this->service->createPageData($request);
    $this->setModuleId($id);
    $data['breadcrumbs'] = $this->breadcrumbForForm('Create');
    return $this->renderView('form', $data);
  }

  /**
   * Create/save a new resource.
   * POST resources
   */
  public function store()
  {
    $request = app()->make($this->request);
    $store = $this->service->store($request);
    $this->setModuleId($store->id);
    return redirect($this->getUrl())->withErrors(['success' => 'Successfully created.']);
  }

  /**
   * Render a form to update an existing resource.
   * GET resources/:id/edit
   */
  public function edit($id)
  {
    $data = $this->service->editPageData($id);
    $this->setModuleId($id);
    $data['breadcrumbs'] = $this->breadcrumbForForm('Edit');
    return $this->renderView('form', $data);
  }

  /**
   * Update resource details.
   * PUT or PATCH resources/:id
   */
    public function update($id="") {
      
      $request = app()->make($this->request);
      $this->service->update($id, $request);
      $this->setModuleId($id);
      return redirect($this->getUrl())->withErrors(['success'=>'Successfully updated.']);
    }

  /**
   * Delete a resource with id.
   * DELETE resources/:id
   */
  public function destroy($id)
  {
    $this->service->delete($id);
    $this->setModuleId($id);
    return redirect($this->getUrl())->withErrors(['success' => 'Successfully deleted.']);
  }
}
