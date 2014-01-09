<?php
namespace Cundd\Rest\Test\Document;

use Cundd\Rest\Domain\Model\Document;

\Tx_CunddComposer_Autoloader::register();
class DummyObject {}

/**
 * Test case for class new \Cundd\Rest\App
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 *
 * @author Daniel Corn <cod@iresults.li>
 */
class DocumentTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var Document
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Document();
		$this->fixture->_setDataProtected(json_encode(array(
			'firstName' => 'Daniel',
			'lastName' => 'Corn',
			'address' => array(
				'street' => 'Bingstreet 1',
				'city' => 'Feldkirch',
				'zip' => '6800',
				'country' => 'Austria',
			)
		)));
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function setContentTest() {
		$content = '{"data": "The new test content"}';
		$this->fixture->_setDataProtected($content);
		$this->assertEquals($content, $this->fixture->_getDataProtected());
	}

	/**
	 * @test
	 */
	public function getInitialContentTest() {
		$model = new Document();
		$result = $model->_getDataProtected();
		$this->assertNull($result);
	}

	/**
	 * @test
	 */
	public function setDbTest() {
		$db = 'testdb';
		$this->fixture->_setDb($db);
		$this->assertEquals($db, $this->fixture->_getDb());

		$db = 'testdb1';
		$this->fixture->_setDb($db);
		$this->assertEquals($db, $this->fixture->_getDb());

		$db = 'test1db2';
		$this->fixture->_setDb($db);
		$this->assertEquals($db, $this->fixture->_getDb());
	}

	/**
	 * @expectException \Cundd\Rest\Domain\Exception\InvalidDatabaseNameException
	 */
	public function setInvalidDbTest() {
		$db = 'test-db';
		$this->fixture->_setDb($db);
	}

	/**
	 * @test
	 */
	public function getInitialDbTest() {
		$result = $this->fixture->_getDb();
		$this->assertEquals('', $result);
	}

	/**
	 * @test
	 */
	public function changeGuidTest() {
		$id = time();
		$database = 'testdb';
		$this->fixture->setId($id);
		$this->fixture->_setDb($database);
		$this->assertEquals($database . '-' . $id, $this->fixture->getGuid());

	}

	/**
	 * @test
	 */
	public function getInitialGuidTest() {
		$result = $this->fixture->getGuid();
		$this->assertNull($result);

	}

	/**
	 * @test
	 */
	public function valueForKeyTest() {
		$key = 'firstName';
		$result = $this->fixture->valueForKey($key);
		$this->assertEquals('Daniel', $result);

	}

	/**
	 * @test
	 */
	public function valueForKeyPathTest() {
		$keyPath = 'address.street';
		$result = $this->fixture->valueForKeyPath($keyPath);
		$this->assertEquals('Bingstreet 1', $result);

	}

	/**
	 * @test
	 */
	public function valueForUndefinedKeyTest() {
		$undefinedKey = 'undefined';
		$result = $this->fixture->valueForUndefinedKey($undefinedKey);
		$this->assertNull($result);
	}

	/**
	 * @test
	 */
	public function setValueForKeyTest() {
		$function = 'Superman';
		$key = 'function';

		$this->fixture->setValueForKey($function, $key);
		$this->assertEquals($function, $this->fixture->valueForKey($key));
	}

//	/**
//	 * @test
//	 */
//	public function setValueForKeyPathTest() {
//		$value = 'Antarctic';
//		$keyPath = 'address.country';
//		$this->fixture->setValueForKeyPath($value, $keyPath);
//		$this->assertEquals($value, $this->fixture->valueForKeyPath($keyPath));
//	}

	/**
	 * @test
	 */
	public function offsetExistsTest() {
		$this->assertTrue($this->fixture->offsetExists('firstName'));
	}

	/**
	 * @test
	 */
	public function offsetExistsArrayTest() {
		$this->assertTrue(isset($this->fixture['firstName']));
	}

	/**
	 * @test
	 */
	public function offsetGetTest() {
		$this->assertEquals('Daniel', $this->fixture->offsetGet('firstName'));
	}

	/**
	 * @test
	 */
	public function offsetGetArrayTest() {
		$this->assertEquals('Daniel', $this->fixture['firstName']);
	}

	/**
	 * @test
	 */
	public function offsetSetTest() {
		$function = 'Superman';
		$key = 'function';

		$this->fixture->offsetSet($key, $function);
		$this->assertEquals($function, $this->fixture->valueForKey($key));
	}

	/**
	 * @test
	 */
	public function offsetSetArrayTest() {
		$function = 'Superman';
		$key = 'function';

		$this->fixture[$key] = $function;
		$this->assertEquals($function, $this->fixture->valueForKey($key));
	}

	/**
	 * @test
	 */
	public function offsetUnsetTest() {
		$key = 'firstName';
		$this->fixture->offsetUnset($key);
		$this->assertNull($this->fixture->valueForKey($key));
	}

	/**
	 * @test
	 */
	public function offsetUnsetArrayTest() {
		$key = 'firstName';
		unset($this->fixture[$key]);
		$this->assertNull($this->fixture->valueForKey($key));
	}


}
?>