<?php declare(strict_types=1);

use App\Application\Mail\ArchiveMailer;
use App\Domain\AggregateRoot\DomainEventPublisher;
use App\Infrastructure\Action\Archived\ArchivedAction;
use App\Infrastructure\Action\CreateEmployee\CreateEmployeeAction;
use App\Infrastructure\Action\Employees\EmployeesAction;
use App\Infrastructure\Http\RequestFactory;
use App\Infrastructure\Http\Router;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$request = RequestFactory::fromGlobals();

// Subscribers
DomainEventPublisher::instance()->subscribe(new ArchiveMailer());

// Routing
Router::route('/create/', new CreateEmployeeAction());
Router::route('/employees/', new EmployeesAction());
Router::route('/archived/', new ArchivedAction());

$response = Router::execute($request);
$sender = new \App\Infrastructure\Http\ResponseSender();
$sender->send($response);
