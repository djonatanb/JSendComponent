```
class AppController extends Controller {

	public function beforeRender(){
		$this->JSend->setSerialize();
	}
```

```
class BadgesController extends AppController {
	$badges = $this->Badge->find('all');
	$this->JSend->setJson($badges, 'success');
}
```