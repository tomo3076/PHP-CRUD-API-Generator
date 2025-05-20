<?php
namespace App;

class Router
{
    private Database $db;
    private SchemaInspector $inspector;
    private ApiGenerator $api;
    public Authenticator $auth;

    public function __construct(Database $db, Authenticator $auth)
    {
        $pdo = $db->getPdo();
        $this->db = $db;
        $this->inspector = new SchemaInspector($pdo);
        $this->api = new ApiGenerator($pdo);
        $this->auth = $auth;
    }

    public function route(array $query)
    {
        header('Content-Type: application/json');

        // JWT login endpoint (always accessible if method is JWT)
        if (($query['action'] ?? '') === 'login' && ($this->auth->config['auth_method'] ?? '') === 'jwt') {
            $post = $_POST;
            $users = $this->auth->config['basic_users'] ?? [];
            $user = $post['username'] ?? '';
            $pass = $post['password'] ?? '';
            if (isset($users[$user]) && $users[$user] === $pass) {
                $token = $this->auth->createJwt(['sub' => $user]);
                echo json_encode(['token' => $token]);
            } else {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid credentials']);
            }
            return;
        }

        // Require authentication for all others
        $this->auth->requireAuth();

        try {
            switch ($query['action'] ?? '') {
                case 'tables':
                    echo json_encode($this->inspector->getTables());
                    break;
                case 'columns':
                    if (isset($query['table'])) {
                        echo json_encode($this->inspector->getColumns($query['table']));
                    } else {
                        http_response_code(400);
                        echo json_encode(['error' => 'Missing table parameter']);
                    }
                    break;
                case 'list':
                    if (isset($query['table'])) {
                        echo json_encode($this->api->list($query['table']));
                    } else {
                        http_response_code(400);
                        echo json_encode(['error' => 'Missing table parameter']);
                    }
                    break;
                case 'read':
                    if (isset($query['table'], $query['id'])) {
                        echo json_encode($this->api->read($query['table'], $query['id']));
                    } else {
                        http_response_code(400);
                        echo json_encode(['error' => 'Missing table or id parameter']);
                    }
                    break;
                case 'create':
                    if (isset($query['table'])) {
                        $data = $_POST;
                        echo json_encode($this->api->create($query['table'], $data));
                    } else {
                        http_response_code(400);
                        echo json_encode(['error' => 'Missing table parameter']);
                    }
                    break;
                case 'update':
                    if (isset($query['table'], $query['id'])) {
                        $data = $_POST;
                        echo json_encode($this->api->update($query['table'], $query['id'], $data));
                    } else {
                        http_response_code(400);
                        echo json_encode(['error' => 'Missing table or id parameter']);
                    }
                    break;
                case 'delete':
                    if (isset($query['table'], $query['id'])) {
                        echo json_encode(['success' => $this->api->delete($query['table'], $query['id'])]);
                    } else {
                        http_response_code(400);
                        echo json_encode(['error' => 'Missing table or id parameter']);
                    }
                    break;
                case 'openapi':
                    echo json_encode(OpenApiGenerator::generate(
                        $this->inspector->getTables(),
                        $this->inspector
                    ));
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['error' => 'Invalid action']);
            }
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}