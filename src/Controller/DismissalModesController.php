<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DismissalModes Controller
 *
 * @property \App\Model\Table\DismissalModesTable $DismissalModes
 */
class DismissalModesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('dismissalModes', $this->paginate($this->DismissalModes));
        $this->set('_serialize', ['dismissalModes']);
    }

    /**
     * View method
     *
     * @param string|null $id Dismissal Mode id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dismissalMode = $this->DismissalModes->get($id, [
            'contain' => ['Matches']
        ]);
        $this->set('dismissalMode', $dismissalMode);
        $this->set('_serialize', ['dismissalMode']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dismissalMode = $this->DismissalModes->newEntity();
        if ($this->request->is('post')) {
            $dismissalMode = $this->DismissalModes->patchEntity($dismissalMode, $this->request->data);
            if ($this->DismissalModes->save($dismissalMode)) {
                $this->Flash->success(__('The dismissal mode has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dismissal mode could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dismissalMode'));
        $this->set('_serialize', ['dismissalMode']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dismissal Mode id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dismissalMode = $this->DismissalModes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dismissalMode = $this->DismissalModes->patchEntity($dismissalMode, $this->request->data);
            if ($this->DismissalModes->save($dismissalMode)) {
                $this->Flash->success(__('The dismissal mode has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dismissal mode could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dismissalMode'));
        $this->set('_serialize', ['dismissalMode']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dismissal Mode id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dismissalMode = $this->DismissalModes->get($id);
        if ($this->DismissalModes->delete($dismissalMode)) {
            $this->Flash->success(__('The dismissal mode has been deleted.'));
        } else {
            $this->Flash->error(__('The dismissal mode could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
