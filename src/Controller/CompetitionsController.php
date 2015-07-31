<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Competitions Controller
 *
 * @property \App\Model\Table\CompetitionsTable $Competitions
 */
class CompetitionsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('competitions', $this->paginate($this->Competitions));
        $this->set('_serialize', ['competitions']);
    }

    /**
     * View method
     *
     * @param string|null $id Competition id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competition = $this->Competitions->get($id, [
            'contain' => ['Matches']
        ]);
        $this->set('competition', $competition);
        $this->set('_serialize', ['competition']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competition = $this->Competitions->newEntity();
        if ($this->request->is('post')) {
            $competition = $this->Competitions->patchEntity($competition, $this->request->data);
            if ($this->Competitions->save($competition)) {
                $this->Flash->success(__('The competition has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The competition could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('competition'));
        $this->set('_serialize', ['competition']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Competition id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competition = $this->Competitions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competition = $this->Competitions->patchEntity($competition, $this->request->data);
            if ($this->Competitions->save($competition)) {
                $this->Flash->success(__('The competition has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The competition could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('competition'));
        $this->set('_serialize', ['competition']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Competition id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competition = $this->Competitions->get($id);
        if ($this->Competitions->delete($competition)) {
            $this->Flash->success(__('The competition has been deleted.'));
        } else {
            $this->Flash->error(__('The competition could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
